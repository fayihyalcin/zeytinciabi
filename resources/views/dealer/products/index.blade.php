@extends('layouts.dealer')

@section('title', 'Ürünler')
@section('page_subtitle', 'Satışa açılan ürünlerini ve bayi fiyatlarını yönet')

@section('content')
<section class="welcome">
    <div>
        <h1>Ürünlerim <span class="leaf-mark">•</span></h1>
        <p>Satış fiyatını belirle, karını gör, ürünü landing page akışına hazırla.</p>
    </div>
</section>

<section class="grid gap-4">
    @forelse ($products as $dealerProduct)
        @php
            $product = $dealerProduct->product;
            $price = $dealerProduct->productPrice;
            $salePrice = old("custom_sale_price_{$dealerProduct->id}", $dealerProduct->custom_sale_price ?? $price?->suggested_sale_price ?? 0);
            $profit = max(0, (float) $salePrice - (float) ($price?->dealer_buy_price ?? 0));
        @endphp
        <article class="card p-5">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex gap-4">
                    <div class="h-24 w-24 overflow-hidden rounded-2xl border border-[#e6dccb] bg-[#fbf8f2]">
                        @if($product?->main_image)
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="grid h-full place-items-center text-3xl">🌿</div>
                        @endif
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="font-serif text-2xl font-bold text-[#1f241b]">{{ $product?->name }}</h2>
                            <x-status-badge :value="$dealerProduct->is_enabled ? 'active' : 'passive'" />
                        </div>
                        <p class="mt-1 text-sm text-[#6b6d65]">{{ $product?->category?->name ?? 'Kategori yok' }} · {{ $product?->sku ?? 'SKU yok' }}</p>
                        <div class="mt-4 grid gap-2 text-sm sm:grid-cols-4">
                            <span><strong>Alış:</strong> {{ number_format((float) ($price?->dealer_buy_price ?? 0), 2, ',', '.') }} TL</span>
                            <span><strong>Önerilen:</strong> {{ number_format((float) ($price?->suggested_sale_price ?? 0), 2, ',', '.') }} TL</span>
                            <span><strong>Minimum:</strong> {{ number_format((float) ($price?->min_sale_price ?? 0), 2, ',', '.') }} TL</span>
                            <span><strong>Kar:</strong> {{ number_format($profit, 2, ',', '.') }} TL</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('dealer.products.price.update', $dealerProduct) }}" class="grid gap-3 rounded-2xl border border-[#e6dccb] bg-[#fffdf8] p-4 sm:min-w-[320px]">
                    @csrf
                    @method('PATCH')
                    <label class="grid gap-1 text-sm font-semibold text-[#3f463b]">
                        Satış fiyatın
                        <input name="custom_sale_price" type="number" step="0.01" min="{{ $price?->min_sale_price ?? 0 }}" @if($price?->max_sale_price) max="{{ $price->max_sale_price }}" @endif value="{{ $salePrice }}" class="rounded-xl border border-[#d8cdb9] bg-white px-3 py-2">
                    </label>
                    <label class="flex items-center gap-2 text-sm font-semibold text-[#3f463b]">
                        <input name="is_enabled" type="checkbox" value="1" @checked(old("is_enabled_{$dealerProduct->id}", $dealerProduct->is_enabled))>
                        Satışa açık
                    </label>
                    <button class="create-btn justify-center" type="submit">Fiyatı Güncelle</button>
                </form>
            </div>
        </article>
    @empty
        <article class="card p-8 text-center text-[#6b6d65]">Henüz sana atanmış ürün yok. Süper admin ürün atadığında burada görünecek.</article>
    @endforelse
</section>

<div class="mt-5">{{ $products->links() }}</div>
@endsection
