<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'dealer_product_id',
        'landing_page_product_id',
        'product_name_snapshot',
        'quantity',
        'dealer_buy_price_snapshot',
        'sale_price_snapshot',
        'line_total',
        'dealer_profit',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'dealer_buy_price_snapshot' => 'decimal:2',
            'sale_price_snapshot' => 'decimal:2',
            'line_total' => 'decimal:2',
            'dealer_profit' => 'decimal:2',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function dealerProduct(): BelongsTo
    {
        return $this->belongsTo(DealerProduct::class);
    }

    public function landingPageProduct(): BelongsTo
    {
        return $this->belongsTo(LandingPageProduct::class);
    }
}
