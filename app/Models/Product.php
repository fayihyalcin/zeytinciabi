<?php

namespace App\Models;

use App\Enums\StockStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'main_image',
        'volume_liter',
        'package_type',
        'stock_quantity',
        'stock_status',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'volume_liter' => 'decimal:3',
            'stock_quantity' => 'integer',
            'stock_status' => StockStatus::class,
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function dealerProducts(): HasMany
    {
        return $this->hasMany(DealerProduct::class);
    }

    public function landingPages(): BelongsToMany
    {
        return $this->belongsToMany(LandingPage::class, 'landing_page_products')
            ->withPivot(['dealer_product_id', 'sale_price', 'sort_order', 'is_active'])
            ->withTimestamps();
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
