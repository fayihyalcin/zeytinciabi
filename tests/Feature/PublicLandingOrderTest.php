<?php

namespace Tests\Feature;

use App\Enums\DealerStatus;
use App\Enums\EarningStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\StockStatus;
use App\Enums\UserRole;
use App\Models\DealerProduct;
use App\Models\DealerProfile;
use App\Models\LandingPage;
use App\Models\LandingPageProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use App\Services\LandingPageBuilderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PublicLandingOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_landing_page_can_create_order_and_earning(): void
    {
        [$landingPage, $landingProduct] = $this->landingPageFixture();

        $this->get(route('public.landing.show', $landingPage))
            ->assertOk()
            ->assertSee('Ayşe Zeytinyağı')
            ->assertSee('Natürel Sızma');

        $this->post(route('public.landing.orders.store', $landingPage), [
            'customer_name' => 'Müşteri İbrahim',
            'customer_phone' => '05551234567',
            'customer_city' => 'İzmir',
            'customer_district' => 'Çeşme',
            'customer_address' => 'Alaçatı mahallesi',
            'items' => [
                ['landing_page_product_id' => $landingProduct->id, 'quantity' => 2],
            ],
        ])->assertRedirect(route('public.landing.show', $landingPage));

        $order = Order::with(['items', 'earning'])->firstOrFail();

        $this->assertSame($landingPage->dealer_id, $order->dealer_id);
        $this->assertSame(OrderStatus::Pending, $order->order_status);
        $this->assertSame(PaymentStatus::CodPending, $order->payment_status);
        $this->assertSame('2300.00', (string) $order->total_amount);
        $this->assertSame('1600.00', (string) $order->dealer_total_cost);
        $this->assertSame('700.00', (string) $order->dealer_total_profit);
        $this->assertSame('Natürel Sızma', $order->items->first()->product_name_snapshot);
        $this->assertSame(EarningStatus::Pending, $order->earning->status);
        $this->assertSame('700.00', (string) $order->earning->amount);
    }

    public function test_inactive_landing_page_is_not_public(): void
    {
        [$landingPage] = $this->landingPageFixture(isActive: false);

        $this->get(route('public.landing.show', $landingPage))->assertNotFound();
    }

    public function test_order_cannot_use_product_from_another_landing_page(): void
    {
        [$landingPage] = $this->landingPageFixture();
        [, $otherLandingProduct] = $this->landingPageFixture(slug: 'baska-landing');

        $this->post(route('public.landing.orders.store', $landingPage), [
            'customer_name' => 'Müşteri İbrahim',
            'customer_phone' => '05551234567',
            'customer_city' => 'İzmir',
            'customer_district' => 'Çeşme',
            'customer_address' => 'Alaçatı mahallesi',
            'items' => [
                ['landing_page_product_id' => $otherLandingProduct->id, 'quantity' => 1],
            ],
        ])->assertSessionHasErrors('items');

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_malformed_order_items_return_validation_errors_instead_of_server_error(): void
    {
        [$landingPage] = $this->landingPageFixture();

        $this->post(route('public.landing.orders.store', $landingPage), [
            'customer_name' => 'Müşteri İbrahim',
            'customer_phone' => '05551234567',
            'customer_city' => 'İzmir',
            'customer_district' => 'Çeşme',
            'customer_address' => 'Alaçatı mahallesi',
            'items' => ['bozuk-veri'],
        ])->assertSessionHasErrors('items');

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_landing_page_builder_rejects_sale_price_under_minimum(): void
    {
        [, $landingProduct] = $this->landingPageFixture();
        $dealerProduct = $landingProduct->dealerProduct()->with('dealer')->firstOrFail();

        $this->expectException(ValidationException::class);

        app(LandingPageBuilderService::class)->create($dealerProduct->dealer, [
            'title' => 'Minimum Altı Landing',
            'is_active' => true,
            'products' => [
                [
                    'dealer_product_id' => $dealerProduct->id,
                    'sale_price' => 900,
                ],
            ],
        ]);
    }

    public function test_landing_page_builder_creates_active_landing_with_valid_price(): void
    {
        [, $landingProduct] = $this->landingPageFixture();
        $dealerProduct = $landingProduct->dealerProduct()->with('dealer')->firstOrFail();

        $landingPage = app(LandingPageBuilderService::class)->create($dealerProduct->dealer, [
            'title' => 'Soğuk Sıkım Landing',
            'is_active' => true,
            'products' => [
                [
                    'dealer_product_id' => $dealerProduct->id,
                    'sale_price' => 1000,
                ],
            ],
        ]);

        $this->assertSame('soguk-sikim-landing', $landingPage->slug);
        $this->assertTrue($landingPage->is_active);
        $this->assertSame('1000.00', (string) $landingPage->landingPageProducts->first()->sale_price);
    }

    /**
     * @return array{0: LandingPage, 1: LandingPageProduct}
     */
    private function landingPageFixture(string $slug = 'ayse-zeytinyagi', bool $isActive = true): array
    {
        $user = User::factory()->create(['role' => UserRole::Dealer]);
        $dealer = DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-'.strtoupper(str($slug)->replace('-', '')->substr(0, 6)->toString()),
            'dealer_slug' => $slug.'-dealer',
            'display_name' => 'Ayşe Bayi',
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);
        $product = Product::create([
            'name' => 'Natürel Sızma',
            'slug' => $slug.'-product',
            'stock_status' => StockStatus::InStock,
        ]);
        $price = ProductPrice::create([
            'product_id' => $product->id,
            'normal_sale_price' => 1200,
            'dealer_buy_price' => 800,
            'suggested_sale_price' => 1150,
            'min_sale_price' => 950,
        ]);
        $dealerProduct = DealerProduct::create([
            'dealer_id' => $dealer->id,
            'product_id' => $product->id,
            'product_price_id' => $price->id,
            'is_enabled' => true,
        ]);
        $landingPage = LandingPage::create([
            'dealer_id' => $dealer->id,
            'title' => 'Ayşe Zeytinyağı',
            'slug' => $slug,
            'is_active' => $isActive,
            'published_at' => $isActive ? now() : null,
        ]);
        $landingProduct = LandingPageProduct::create([
            'landing_page_id' => $landingPage->id,
            'product_id' => $product->id,
            'dealer_product_id' => $dealerProduct->id,
            'sale_price' => 1150,
            'is_active' => true,
        ]);

        return [$landingPage, $landingProduct];
    }
}
