<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingPageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_page_id',
        'product_id',
        'dealer_product_id',
        'sale_price',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sale_price' => 'decimal:2',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function landingPage(): BelongsTo
    {
        return $this->belongsTo(LandingPage::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function dealerProduct(): BelongsTo
    {
        return $this->belongsTo(DealerProduct::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
