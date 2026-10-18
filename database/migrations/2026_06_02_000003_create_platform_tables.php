<?php

use App\Enums\EarningStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\PayoutStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_products', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_profiles')->restrictOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('product_price_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('custom_sale_price', 12, 2)->nullable();
            $table->boolean('is_enabled')->default(true)->index();
            $table->timestamps();

            $table->unique(['dealer_id', 'product_id']);
            $table->index(['product_id', 'is_enabled']);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable()->index();
            $table->date('end_date')->nullable()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('landing_page_templates', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('name');
            $table->string('key')->unique();
            $table->string('preview_image')->nullable();
            $table->string('view_path');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('landing_pages', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_profiles')->restrictOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('template_id')->nullable()->constrained('landing_page_templates')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('headline')->nullable();
            $table->string('subheadline')->nullable();
            $table->longText('description')->nullable();
            $table->string('whatsapp_phone', 32)->nullable();
            $table->string('facebook_pixel_id')->nullable();
            $table->string('tiktok_pixel_id')->nullable();
            $table->string('google_tag_id')->nullable();
            $table->longText('custom_css')->nullable();
            $table->boolean('is_active')->default(false)->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['dealer_id', 'is_active']);
            $table->index(['project_id', 'is_active']);
        });

        Schema::create('landing_page_products', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('landing_page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('dealer_product_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('sale_price', 12, 2);
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->unique(['landing_page_id', 'product_id']);
            $table->index(['product_id', 'is_active']);
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('name');
            $table->string('phone', 32)->index();
            $table->string('city', 80)->nullable()->index();
            $table->string('district', 80)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->index(['phone', 'created_at']);
        });

        Schema::create('cargo_companies', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('name');
            $table->string('code', 80)->nullable()->unique();
            $table->string('tracking_url_template')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('order_number', 40)->unique();
            $table->foreignId('dealer_id')->constrained('dealer_profiles')->restrictOnDelete();
            $table->foreignId('landing_page_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone', 32)->index();
            $table->string('customer_city', 80);
            $table->string('customer_district', 80);
            $table->text('customer_address');
            $table->text('customer_note')->nullable();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('dealer_total_cost', 12, 2)->default(0);
            $table->decimal('dealer_total_profit', 12, 2)->default(0);
            $table->string('payment_method', 32)->default(PaymentMethod::CashOnDelivery->value)->index();
            $table->string('payment_status', 32)->default(PaymentStatus::Pending->value)->index();
            $table->string('order_status', 32)->default(OrderStatus::Pending->value)->index();
            $table->foreignId('cargo_company_id')->nullable()->constrained()->nullOnDelete();
            $table->string('cargo_tracking_number')->nullable()->index();
            $table->string('cargo_tracking_url')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('prepared_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['dealer_id', 'created_at']);
            $table->index(['dealer_id', 'order_status']);
            $table->index(['landing_page_id', 'created_at']);
            $table->index(['project_id', 'created_at']);
            $table->index(['payment_status', 'order_status']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('dealer_product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('landing_page_product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name_snapshot');
            $table->unsignedInteger('quantity');
            $table->decimal('dealer_buy_price_snapshot', 12, 2);
            $table->decimal('sale_price_snapshot', 12, 2);
            $table->decimal('line_total', 12, 2);
            $table->decimal('dealer_profit', 12, 2);
            $table->timestamps();

            $table->index(['order_id', 'product_id']);
        });

        Schema::create('dealer_earnings', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_profiles')->restrictOnDelete();
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('status', 32)->default(EarningStatus::Pending->value)->index();
            $table->timestamp('payable_at')->nullable()->index();
            $table->timestamp('paid_at')->nullable()->index();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('payment_reference')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['dealer_id', 'status']);
        });

        Schema::create('dealer_payouts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_profiles')->restrictOnDelete();
            $table->string('payout_number', 40)->unique();
            $table->decimal('total_amount', 12, 2);
            $table->string('status', 32)->default(PayoutStatus::Pending->value)->index();
            $table->timestamp('paid_at')->nullable()->index();
            $table->string('bank_name')->nullable();
            $table->string('iban', 34)->nullable();
            $table->string('reference_number')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['dealer_id', 'status']);
        });

        Schema::create('user_notifications', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->string('type')->nullable()->index();
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable()->index();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->nullableMorphs('subject');
            $table->string('action')->index();
            $table->text('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('type', 40)->nullable()->index();
            $table->string('group', 80)->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('user_notifications');
        Schema::dropIfExists('dealer_payouts');
        Schema::dropIfExists('dealer_earnings');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cargo_companies');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('landing_page_products');
        Schema::dropIfExists('landing_pages');
        Schema::dropIfExists('landing_page_templates');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('dealer_products');
    }
};
