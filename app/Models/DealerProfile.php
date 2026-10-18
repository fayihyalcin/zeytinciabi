<?php

namespace App\Models;

use App\Enums\DealerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealerProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'dealer_code',
        'dealer_slug',
        'company_name',
        'display_name',
        'identity_number',
        'tax_number',
        'iban',
        'bank_name',
        'city',
        'district',
        'address',
        'instagram_url',
        'facebook_url',
        'tiktok_url',
        'whatsapp_phone',
        'status',
        'approved_at',
        'rejected_at',
        'rejected_reason',
    ];

    protected function casts(): array
    {
        return [
            'status' => DealerStatus::class,
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dealerProducts(): HasMany
    {
        return $this->hasMany(DealerProduct::class, 'dealer_id');
    }

    public function landingPages(): HasMany
    {
        return $this->hasMany(LandingPage::class, 'dealer_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'dealer_id');
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(DealerEarning::class, 'dealer_id');
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(DealerPayout::class, 'dealer_id');
    }

    public function isApproved(): bool
    {
        return $this->status === DealerStatus::Approved;
    }
}
