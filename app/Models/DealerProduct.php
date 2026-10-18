<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DealerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'product_id',
        'product_price_id',
        'custom_sale_price',
        'is_enabled',
    ];

    protected function casts(): array
    {
        return [
            'custom_sale_price' => 'decimal:2',
            'is_enabled' => 'boolean',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productPrice(): BelongsTo
    {
        return $this->belongsTo(ProductPrice::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function landingPageProducts(): HasMany
    {
        return $this->hasMany(LandingPageProduct::class);
    }

    public function scopeForDealer(Builder $query, int $dealerId): Builder
    {
        return $query->where('dealer_id', $dealerId);
    }
}
