<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'dealer_id',
        'landing_page_id',
        'project_id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_city',
        'customer_district',
        'customer_address',
        'customer_note',
        'total_amount',
        'dealer_total_cost',
        'dealer_total_profit',
        'payment_method',
        'payment_status',
        'order_status',
        'cargo_company_id',
        'cargo_tracking_number',
        'cargo_tracking_url',
        'confirmed_at',
        'prepared_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
        'returned_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'dealer_total_cost' => 'decimal:2',
            'dealer_total_profit' => 'decimal:2',
            'payment_method' => PaymentMethod::class,
            'payment_status' => PaymentStatus::class,
            'order_status' => OrderStatus::class,
            'confirmed_at' => 'datetime',
            'prepared_at' => 'datetime',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'returned_at' => 'datetime',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }

    public function landingPage(): BelongsTo
    {
        return $this->belongsTo(LandingPage::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function cargoCompany(): BelongsTo
    {
        return $this->belongsTo(CargoCompany::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function earning(): HasOne
    {
        return $this->hasOne(DealerEarning::class);
    }

    public function scopeForDealer(Builder $query, int $dealerId): Builder
    {
        return $query->where('dealer_id', $dealerId);
    }
}
