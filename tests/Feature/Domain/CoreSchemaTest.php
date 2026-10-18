<?php

namespace Tests\Feature\Domain;

use App\Enums\DealerStatus;
use App\Enums\EarningStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\PayoutStatus;
use App\Enums\StockStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\ActivityLog;
use App\Models\CargoCompany;
use App\Models\Customer;
use App\Models\DealerEarning;
use App\Models\DealerPayout;
use App\Models\DealerProduct;
use App\Models\DealerProfile;
use App\Models\LandingPage;
use App\Models\LandingPageProduct;
use App\Models\LandingPageTemplate;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CoreSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_core_tables_include_the_expected_isolation_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('orders', [
            'dealer_id',
            'landing_page_id',
            'project_id',
            'customer_id',
            'order_number',
            'total_amount',
            'dealer_total_cost',
            'dealer_total_profit',
            'payment_method',
            'payment_status',
            'order_status',
        ]));

        $this->assertTrue(Schema::hasColumns('order_items', [
            'order_id',
            'product_id',
            'dealer_product_id',
            'landing_page_product_id',
            'product_name_snapshot',
            'dealer_buy_price_snapshot',
            'sale_price_snapshot',
            'line_total',
            'dealer_profit',
        ]));

        $this->assertTrue(Schema::hasColumns('landing_pages', [
            'dealer_id',
            'project_id',
            'template_id',
            'slug',
            'is_active',
            'published_at',
        ]));

        $this->assertTrue(Schema::hasColumns('user_notifications', [
            'user_id',
            'title',
            'message',
            'data',
            'read_at',
        ]));
    }

    public function test_catalog_landing_order_and_earning_relationships_work_with_turkish_text(): void
    {
        $user = User::factory()->create([
            'name' => 'Ayşe Şahin',
            'role' => UserRole::Dealer,
            'status' => UserStatus::Active,
        ]);

        $dealer = DealerProfile::create([
            'user_id' => $user->id,
            'dealer_code' => 'ZA-1001',
            'dealer_slug' => 'ayse-sahin-bayi',
            'display_name' => 'Ayşe Şahin Bayi',
            'status' => DealerStatus::Approved,
            'approved_at' => now(),
        ]);

        $category = ProductCategory::create([
            'name' => 'Natürel Sızma',
            'slug' => 'naturel-sizma',
        ]);

        $product = Product::create([
            'product_category_id' => $category->id,
            'name' => '5 Litre Natürel Sızma Zeytinyağı',
            'slug' => '5-litre-naturel-sizma-zeytinyagi',
            'sku' => 'ZA-5LT',
            'stock_quantity' => 25,
            'stock_status' => StockStatus::InStock,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => 'products/5lt.png',
            'is_main' => true,
        ]);

        $price = ProductPrice::create([
            'product_id' => $product->id,
            'normal_sale_price' => 1200,
            'dealer_buy_price' => 800,
            'suggested_sale_price' => 1100,
            'min_sale_price' => 950,
        ]);

        $dealerProduct = DealerProduct::create([
            'dealer_id' => $dealer->id,
            'product_id' => $product->id,
            'product_price_id' => $price->id,
            'custom_sale_price' => 1150,
        ]);

        $project = Project::create([
            'name' => 'Yaz Kampanyası',
            'slug' => 'yaz-kampanyasi',
        ]);

        $template = LandingPageTemplate::create([
            'name' => 'Zeytinci Abi Standart',
            'key' => 'zeytinci-abi-standard',
            'view_path' => 'public.landing-templates.standard',
        ]);

        $landingPage = LandingPage::create([
            'dealer_id' => $dealer->id,
            'project_id' => $project->id,
            'template_id' => $template->id,
            'title' => 'Ayşe Şahin Zeytinyağı',
            'slug' => 'ayse-sahin-zeytinyagi',
            'is_active' => true,
            'published_at' => now(),
        ]);

        $landingProduct = LandingPageProduct::create([
            'landing_page_id' => $landingPage->id,
            'product_id' => $product->id,
            'dealer_product_id' => $dealerProduct->id,
            'sale_price' => 1150,
        ]);

        $customer = Customer::create([
            'name' => 'Müşteri İbrahim',
            'phone' => '05551234567',
            'city' => 'İzmir',
            'district' => 'Çeşme',
            'address' => 'Alaçatı mahallesi',
        ]);

        $cargoCompany = CargoCompany::create([
            'name' => 'Hızlı Kargo',
            'code' => 'HIZLI',
        ]);

        $order = Order::create([
            'order_number' => 'ZA202606020001',
            'dealer_id' => $dealer->id,
            'landing_page_id' => $landingPage->id,
            'project_id' => $project->id,
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'customer_city' => $customer->city,
            'customer_district' => $customer->district,
            'customer_address' => $customer->address,
            'total_amount' => 2300,
            'dealer_total_cost' => 1600,
            'dealer_total_profit' => 700,
            'payment_method' => PaymentMethod::CashOnDelivery,
            'payment_status' => PaymentStatus::CodPending,
            'order_status' => OrderStatus::Pending,
            'cargo_company_id' => $cargoCompany->id,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'dealer_product_id' => $dealerProduct->id,
            'landing_page_product_id' => $landingProduct->id,
            'product_name_snapshot' => $product->name,
            'quantity' => 2,
            'dealer_buy_price_snapshot' => 800,
            'sale_price_snapshot' => 1150,
            'line_total' => 2300,
            'dealer_profit' => 700,
        ]);

        $earning = DealerEarning::create([
            'dealer_id' => $dealer->id,
            'order_id' => $order->id,
            'amount' => 700,
            'status' => EarningStatus::Pending,
        ]);

        DealerPayout::create([
            'dealer_id' => $dealer->id,
            'payout_number' => 'PO202606020001',
            'total_amount' => 700,
            'status' => PayoutStatus::Pending,
        ]);

        UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Yeni sipariş',
            'message' => 'Yeni bir siparişiniz var.',
            'data' => ['order_number' => $order->order_number],
        ]);

        ActivityLog::create([
            'user_id' => $user->id,
            'subject_type' => Order::class,
            'subject_id' => $order->id,
            'action' => 'order.created',
        ]);

        Setting::create([
            'key' => 'general.site_name',
            'value' => 'Zeytinci Abi',
            'type' => 'string',
            'group' => 'general',
        ]);

        $this->assertSame('Ayşe Şahin Bayi', $order->dealer->display_name);
        $this->assertSame('Natürel Sızma', $product->category->name);
        $this->assertSame('5 Litre Natürel Sızma Zeytinyağı', $order->items()->first()->product_name_snapshot);
        $this->assertSame($earning->id, $order->earning->id);
        $this->assertSame(1, LandingPage::forDealer($dealer->id)->count());
        $this->assertSame(1, Order::forDealer($dealer->id)->count());
        $this->assertSame(1, $user->userNotifications()->unread()->count());
    }
}
