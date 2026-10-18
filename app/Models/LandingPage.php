<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandingPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dealer_id',
        'project_id',
        'template_id',
        'title',
        'slug',
        'headline',
        'subheadline',
        'description',
        'whatsapp_phone',
        'facebook_pixel_id',
        'tiktok_pixel_id',
        'google_tag_id',
        'custom_css',
        'is_active',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(LandingPageTemplate::class, 'template_id');
    }

    public function landingPageProducts(): HasMany
    {
        return $this->hasMany(LandingPageProduct::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'landing_page_products')
            ->withPivot(['dealer_product_id', 'sale_price', 'sort_order', 'is_active'])
            ->withTimestamps();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeForDealer(Builder $query, int $dealerId): Builder
    {
        return $query->where('dealer_id', $dealerId);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
