<?php

namespace Tests\Feature\Admin;

use App\Enums\DealerStatus;
use App\Enums\StockStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\DealerProfile;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_foundation_pages_render(): void
    {
        $admin = $this->admin();

        foreach ([
            route('admin.dashboard'),
            route('admin.dealers.index'),
            route('admin.dealers.pending'),
            route('admin.product-categories.index'),
            route('admin.products.index'),
            route('admin.product-prices.index'),
            route('admin.orders.index'),
            route('admin.earnings.index'),
            route('admin.payouts.index'),
            route('admin.reports.index'),
            route('admin.settings.index'),
        ] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_admin_can_create_and_update_product_category_with_turkish_slug(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->post(route('admin.product-categories.store'), [
                'name' => 'Natürel Sızma Ürünleri',
                'description' => 'Türkçe karakter destekli kategori',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.product-categories.index'));

        $category = ProductCategory::firstOrFail();

        $this->assertSame('naturel-sizma-urunleri', $category->slug);

        $this->actingAs($admin)
            ->put(route('admin.product-categories.update', $category), [
                'name' => 'Soğuk Sıkım Ürünleri',
                'description' => 'Güncel açıklama',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.product-categories.index'));

        $this->assertSame('soguk-sikim-urunleri', $category->fresh()->slug);
    }

    public function test_admin_can_create_product_and_price(): void
    {
        $admin = $this->admin();
        $category = ProductCategory::create([
            'name' => 'Zeytinyağı',
            'slug' => 'zeytinyagi',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'product_category_id' => $category->id,
                'name' => '5 Litre Natürel Sızma Zeytinyağı',
                'sku' => 'ZA-5LT-TEST',
                'stock_quantity' => 40,
                'stock_status' => StockStatus::InStock->value,
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.products.index'));

        $product = Product::firstOrFail();

        $this->assertSame('5-litre-naturel-sizma-zeytinyagi', $product->slug);

        $this->actingAs($admin)
            ->post(route('admin.product-prices.store'), [
                'product_id' => $product->id,
                'normal_sale_price' => 1250,
                'dealer_buy_price' => 800,
                'suggested_sale_price' => 1150,
                'min_sale_price' => 950,
                'currency' => 'TRY',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.product-prices.index'));

        $this->assertDatabaseHas('product_prices', [
            'product_id' => $product->id,
            'dealer_buy_price' => 800,
            'suggested_sale_price' => 1150,
        ]);
    }

    public function test_admin_can_approve_and_reject_dealer(): void
    {
        $admin = $this->admin();
        $dealer = DealerProfile::create([
            'user_id' => User::factory()->create(['role' => UserRole::Dealer])->id,
            'dealer_code' => 'ZA-2001',
            'dealer_slug' => 'bekleyen-bayi',
            'display_name' => 'Bekleyen Bayi',
            'status' => DealerStatus::Pending,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.dealers.approve', $dealer))
            ->assertRedirect();

        $this->assertSame(DealerStatus::Approved, $dealer->fresh()->status);

        $this->actingAs($admin)
            ->post(route('admin.dealers.reject', $dealer), [
                'rejected_reason' => 'Eksik evrak',
            ])
            ->assertRedirect();

        $dealer->refresh();

        $this->assertSame(DealerStatus::Rejected, $dealer->status);
        $this->assertSame('Eksik evrak', $dealer->rejected_reason);
    }

    private function admin(): User
    {
        return User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'status' => UserStatus::Active,
        ]);
    }
}
