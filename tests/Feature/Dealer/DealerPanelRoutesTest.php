<?php

namespace Tests\Feature\Dealer;

use App\Enums\DealerStatus;
use App\Enums\OrderStatus;
use App\Enums\StockStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\DealerEarning;
use App\Models\DealerProduct;
use App\Models\DealerProfile;
use App\Models\LandingPage;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DealerPanelRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_approved_dealer_menu_pages_render(): void
    {
        [$user, $dealer] = $this->dealerUser('Ege Bayi', 'ege-bayi');
        $dealerProduct = $this->dealerProduct($dealer);

        $landingPage = LandingPage::create([
            'dealer_id' => $dealer->id,
            'title' => 'Ege Sayfası',
            'slug' => 'ege-sayfasi',
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'ZA-1001',
            'dealer_id' => $dealer->id,
            'landing_page_id' => $landingPage->id,
            'customer_name' => 'Ali Müşteri',
            'customer_phone' => '05550000000',
            'customer_city' => 'İzmir',
            'customer_district' => 'Urla',
            'customer_address' => 'Merkez',
            'total_amount' => 1200,
            'dealer_total_cost' => 800,
            'dealer_total_profit' => 400,
            'order_status' => OrderStatus::Shipped,
            'cargo_tracking_number' => 'TRK123',
        ]);

        DealerEarning::create([
            'dealer_id' => $dealer->id,
            'order_id' => $order->id,
            'amount' => 400,
        ]);

        foreach ([
            route('dealer.products.index'),
            route('dealer.landing-pages.index'),
            route('dealer.landing-pages.create'),
            route('dealer.landing-pages.edit', $landingPage),
            route('dealer.orders.index'),
            route('dealer.orders.show', $order),
            route('dealer.cargo.index'),
            route('dealer.earnings.index'),
            route('dealer.payouts.index'),
            route('dealer.profile.edit'),
        ] as $url) {
            $this->actingAs($user)->get($url)->assertOk();
        }

        $this->assertDatabaseHas('dealer_products', ['id' => $dealerProduct->id]);
    }

    public function test_dealer_cannot_open_another_dealers_records(): void
    {
        [$user] = $this->dealerUser('Birinci Bayi', 'birinci-bayi');
        [, $otherDealer] = $this->dealerUser('İkinci Bayi', 'ikinci-bayi');
        $otherDealerProduct = $this->dealerProduct($otherDealer);

        $otherLandingPage = LandingPage::create([
            'dealer_id' => $otherDealer->id,
            'title' => 'Başka Sayfa',
            'slug' => 'baska-sayfa',
            'is_active' => true,
        ]);

        $otherOrder = Order::create([
            'order_number' => 'OTHER-1001',
            'dealer_id' => $otherDealer->id,
            'landing_page_id' => $otherLandingPage->id,
            'customer_name' => 'Başka Müşteri',
            'customer_phone' => '05551111111',
            'customer_city' => 'Manisa',
            'customer_district' => 'Akhisar',
            'customer_address' => 'Merkez',
            'order_status' => OrderStatus::Pending,
        ]);

        $this->actingAs($user)->get(route('dealer.orders.show', $otherOrder))->assertForbidden();
        $this->actingAs($user)->get(route('dealer.landing-pages.edit', $otherLandingPage))->assertForbidden();
        $this->actingAs($user)->patch(route('dealer.products.price.update', $otherDealerProduct), [
            'custom_sale_price' => 250,
            'is_enabled' => true,
        ])->assertForbidden();
    }

    /**
     * @return array{0: User, 1: DealerProfile}
     */
    private function dealerUser(string $displayName, string $slug): array
    {
        $user = User::factory()->create([
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        $dealer = DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-'.strtoupper(str($slug)->replace('-', '')->substr(0, 6)->toString()),
            'dealer_slug' => $slug,
            'display_name' => $displayName,
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        return [$user, $dealer];
    }

    private function dealerProduct(DealerProfile $dealer): DealerProduct
    {
        $product = Product::create([
            'name' => 'Natürel Sızma',
            'slug' => 'naturel-sizma-'.$dealer->id,
            'sku' => 'SKU-'.$dealer->id,
            'stock_status' => StockStatus::InStock,
            'is_active' => true,
        ]);

        $price = ProductPrice::create([
            'product_id' => $product->id,
            'normal_sale_price' => 300,
            'dealer_buy_price' => 180,
            'suggested_sale_price' => 260,
            'min_sale_price' => 220,
            'is_active' => true,
        ]);

        return DealerProduct::create([
            'dealer_id' => $dealer->id,
            'product_id' => $product->id,
            'product_price_id' => $price->id,
            'custom_sale_price' => 260,
            'is_enabled' => true,
        ]);
    }
}
