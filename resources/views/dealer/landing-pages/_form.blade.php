@php
    $attachedProducts = $landingPage->exists
        ? $landingPage->landingPageProducts->keyBy('dealer_product_id')
        : collect();
@endphp

@if ($errors->any())
    <div class="session-status">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ $action }}" class="grid gap-5">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <section class="card p-5">
        <h2 class="font-serif text-2xl font-bold">Sayfa Bilgileri</h2>
        <div class="mt-5 grid gap-4 lg:grid-cols-2">
            <label class="grid gap-1 text-sm font-semibold">Başlık
                <input name="title" value="{{ old('title', $landingPage->title) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm font-semibold">Slug
                <input name="slug" value="{{ old('slug', $landingPage->slug) }}" placeholder="otomatik-uretilir" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm font-semibold">Hero başlığı
                <input name="headline" value="{{ old('headline', $landingPage->headline) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm font-semibold">Alt başlık
                <input name="subheadline" value="{{ old('subheadline', $landingPage->subheadline) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm font-semibold lg:col-span-2">Açıklama
                <textarea name="description" rows="4" class="rounded-xl border border-[#d8cdb9] px-3 py-2">{{ old('description', $landingPage->description) }}</textarea>
            </label>
            <label class="grid gap-1 text-sm font-semibold">WhatsApp
                <input name="whatsapp_phone" value="{{ old('whatsapp_phone', $landingPage->whatsapp_phone) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            </label>
            <label class="flex items-center gap-2 text-sm font-semibold">
                <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $landingPage->is_active))>
                Yayında
            </label>
        </div>
    </section>

    <section class="card p-5">
        <h2 class="font-serif text-2xl font-bold">Ürünler</h2>
        <div class="mt-5 grid gap-3">
            @forelse ($dealerProducts as $dealerProduct)
                @php
                    $landingProduct = $attachedProducts->get($dealerProduct->id);
                    $salePrice = old("products.$loop->index.sale_price", $landingProduct?->sale_price ?? $dealerProduct->custom_sale_price ?? $dealerProduct->productPrice?->suggested_sale_price);
                    $checked = old("products.$loop->index.is_active", $landingProduct?->is_active ?? ! $landingPage->exists);
                @endphp
                <div class="rounded-2xl border border-[#e6dccb] bg-[#fbf8f2] p-4">
                    <input type="hidden" name="products[{{ $loop->index }}][dealer_product_id]" value="{{ $dealerProduct->id }}">
                    <input type="hidden" name="products[{{ $loop->index }}][is_active]" value="0">
                    <div class="grid gap-3 lg:grid-cols-[1fr_180px_90px] lg:items-center">
                        <label class="flex items-start gap-3">
                            <input name="products[{{ $loop->index }}][is_active]" type="checkbox" value="1" @checked($checked) class="mt-1">
                            <span>
                                <strong class="block">{{ $dealerProduct->product?->name }}</strong>
                                <small class="text-[#6b6d65]">Min: {{ number_format((float) $dealerProduct->productPrice?->min_sale_price, 2, ',', '.') }} TL · Önerilen: {{ number_format((float) $dealerProduct->productPrice?->suggested_sale_price, 2, ',', '.') }} TL</small>
                            </span>
                        </label>
                        <input name="products[{{ $loop->index }}][sale_price]" type="number" step="0.01" value="{{ $salePrice }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
                        <input name="products[{{ $loop->index }}][sort_order]" type="number" value="{{ old("products.$loop->index.sort_order", $landingProduct?->sort_order ?? $loop->index) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
                    </div>
                </div>
            @empty
                <p class="rounded-2xl border border-dashed border-[#d8cdb9] p-5 text-[#6b6d65]">Aktif ürün bulunamadı. Önce ürünler menüsünden ürünlerini satışa açmalısın.</p>
            @endforelse
        </div>
    </section>

    <section class="card p-5">
        <h2 class="font-serif text-2xl font-bold">Takip Kodları</h2>
        <div class="mt-5 grid gap-4 lg:grid-cols-3">
            <input name="facebook_pixel_id" value="{{ old('facebook_pixel_id', $landingPage->facebook_pixel_id) }}" placeholder="Facebook Pixel ID" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            <input name="tiktok_pixel_id" value="{{ old('tiktok_pixel_id', $landingPage->tiktok_pixel_id) }}" placeholder="TikTok Pixel ID" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            <input name="google_tag_id" value="{{ old('google_tag_id', $landingPage->google_tag_id) }}" placeholder="Google Tag ID" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </div>
    </section>

    <div class="flex flex-wrap gap-3">
        <button class="create-btn" type="submit">Kaydet</button>
        <a href="{{ route('dealer.landing-pages.index') }}" class="create-btn logout">Listeye Dön</a>
    </div>
</form>
