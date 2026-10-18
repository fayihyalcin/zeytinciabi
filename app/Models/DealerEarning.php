<?php

namespace App\Models;

use App\Enums\EarningStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealerEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'order_id',
        'amount',
        'status',
        'payable_at',
        'paid_at',
        'cancelled_at',
        'payment_reference',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => EarningStatus::class,
            'payable_at' => 'datetime',
            'paid_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeForDealer(Builder $query, int $dealerId): Builder
    {
        return $query->where('dealer_id', $dealerId);
    }
}
