<?php

namespace App\Models;

use App\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealerPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'payout_number',
        'total_amount',
        'status',
        'paid_at',
        'bank_name',
        'iban',
        'reference_number',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'status' => PayoutStatus::class,
            'paid_at' => 'datetime',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }

    public function scopeForDealer(Builder $query, int $dealerId): Builder
    {
        return $query->where('dealer_id', $dealerId);
    }
}
