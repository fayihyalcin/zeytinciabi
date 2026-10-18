<?php

namespace App\Services;

use App\Models\DealerProfile;
use App\Models\DealerProduct;
use App\Models\LandingPage;
use App\Models\LandingPageProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LandingPageBuilderService
{
    public function __construct(private readonly SlugService $slugService)
    {
    }

    public function create(DealerProfile $dealer, array $data): LandingPage
    {
        return DB::transaction(function () use ($dealer, $data): LandingPage {
            $landingPage = LandingPage::create([
                'dealer_id' => $dealer->id,
                'project_id' => $data['project_id'] ?? null,
                'template_id' => $data['template_id'] ?? null,
                'title' => $data['title'],
                'slug' => $this->slugService->unique($data['slug'] ?? $data['title'], LandingPage::class),
                'headline' => $data['headline'] ?? null,
                'subheadline' => $data['subheadline'] ?? null,
                'description' => $data['description'] ?? null,
                'whatsapp_phone' => $data['whatsapp_phone'] ?? null,
                'facebook_pixel_id' => $data['facebook_pixel_id'] ?? null,
                'tiktok_pixel_id' => $data['tiktok_pixel_id'] ?? null,
                'google_tag_id' => $data['google_tag_id'] ?? null,
                'custom_css' => $data['custom_css'] ?? null,
                'is_active' => (bool) ($data['is_active'] ?? false),
                'published_at' => ! empty($data['is_active']) ? now() : null,
            ]);

            $this->syncProducts($landingPage, $dealer, $data['products']);

            return $landingPage->fresh('landingPageProducts');
        });
    }

    public function update(LandingPage $landingPage, array $data): LandingPage
    {
        return DB::transaction(function () use ($landingPage, $data): LandingPage {
            $dealer = $landingPage->dealer()->lockForUpdate()->firstOrFail();

            $landingPage->update([
                'title' => $data['title'],
                'slug' => $this->slugService->unique($data['slug'] ?? $data['title'], LandingPage::class, ignoreId: $landingPage->id),
                'headline' => $data['headline'] ?? null,
                'subheadline' => $data['subheadline'] ?? null,
                'description' => $data['description'] ?? null,
                'whatsapp_phone' => $data['whatsapp_phone'] ?? null,
                'facebook_pixel_id' => $data['facebook_pixel_id'] ?? null,
                'tiktok_pixel_id' => $data['tiktok_pixel_id'] ?? null,
                'google_tag_id' => $data['google_tag_id'] ?? null,
                'custom_css' => $data['custom_css'] ?? null,
                'is_active' => (bool) ($data['is_active'] ?? false),
                'published_at' => ! empty($data['is_active']) ? ($landingPage->published_at ?? now()) : null,
            ]);

            $this->syncProducts($landingPage, $dealer, $data['products']);

            return $landingPage->fresh('landingPageProducts');
        });
    }

    private function syncProducts(LandingPage $landingPage, DealerProfile $dealer, array $products): void
    {
        $activeProducts = collect($products)
            ->filter(fn (array $productData): bool => (bool) ($productData['is_active'] ?? true))
            ->values();

        $keptProductIds = [];

        foreach ($activeProducts as $productData) {
            $dealerProduct = DealerProduct::with(['product', 'productPrice'])
                ->forDealer($dealer->id)
                ->whereKey($productData['dealer_product_id'])
                ->where('is_enabled', true)
                ->lockForUpdate()
                ->firstOrFail();

            if (! $dealerProduct->product?->is_active || ! $dealerProduct->productPrice?->is_active) {
                throw ValidationException::withMessages([
                    'products' => "{$dealerProduct->product?->name} ürünü şu anda satışa açık değil.",
                ]);
            }

            $salePrice = (float) $productData['sale_price'];
            $minSalePrice = (float) $dealerProduct->productPrice->min_sale_price;
            $maxSalePrice = $dealerProduct->productPrice->max_sale_price !== null
                ? (float) $dealerProduct->productPrice->max_sale_price
                : null;

            if ($salePrice < $minSalePrice) {
                throw ValidationException::withMessages([
                    'products' => "{$dealerProduct->product->name} için satış fiyatı minimum fiyatın altında olamaz.",
                ]);
            }

            if ($maxSalePrice !== null && $salePrice > $maxSalePrice) {
                throw ValidationException::withMessages([
                    'products' => "{$dealerProduct->product->name} için satış fiyatı maksimum fiyatın üstünde olamaz.",
                ]);
            }

            LandingPageProduct::updateOrCreate(
                [
                    'landing_page_id' => $landingPage->id,
                    'product_id' => $dealerProduct->product_id,
                ],
                [
                    'dealer_product_id' => $dealerProduct->id,
                    'sale_price' => $salePrice,
                    'sort_order' => $productData['sort_order'] ?? 0,
                    'is_active' => true,
                ]
            );

            $keptProductIds[] = $dealerProduct->product_id;
        }

        $landingPage->landingPageProducts()
            ->whereNotIn('product_id', $keptProductIds)
            ->delete();
    }
}
