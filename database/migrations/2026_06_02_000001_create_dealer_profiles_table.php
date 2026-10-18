<?php

use App\Enums\DealerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_profiles', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_turkish_ci';

            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnDelete();
            $table->string('dealer_code', 40)->unique();
            $table->string('dealer_slug')->unique();
            $table->string('company_name')->nullable();
            $table->string('display_name');
            $table->string('identity_number', 32)->nullable()->index();
            $table->string('tax_number', 32)->nullable()->index();
            $table->string('iban', 34)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('city', 80)->nullable()->index();
            $table->string('district', 80)->nullable();
            $table->text('address')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('whatsapp_phone', 32)->nullable();
            $table->string('status', 32)->default(DealerStatus::Pending->value)->index();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_profiles');
    }
};
