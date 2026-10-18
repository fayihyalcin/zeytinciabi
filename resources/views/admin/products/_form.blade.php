@csrf

@php
    $currentStockStatus = old('stock_status', $product->stock_status instanceof \BackedEnum ? $product->stock_status->value : $product->stock_status);
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <label class="grid gap-1 text-sm font-semibold">
        Ürün Adı
        <input name="name" value="{{ old('name', $product->name) }}" class="rounded-lg border-[#d8cdb9]" required>
        @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Kategori
        <select name="product_category_id" class="rounded-lg border-[#d8cdb9]">
            <option value="">Seçimsiz</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('product_category_id', $product->product_category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Slug
        <input name="slug" value="{{ old('slug', $product->slug) }}" class="rounded-lg border-[#d8cdb9]" placeholder="Boşsa otomatik">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        SKU
        <input name="sku" value="{{ old('sku', $product->sku) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold md:col-span-2">
        Kısa Açıklama
        <textarea name="short_description" rows="2" class="rounded-lg border-[#d8cdb9]">{{ old('short_description', $product->short_description) }}</textarea>
    </label>
    <label class="grid gap-1 text-sm font-semibold md:col-span-2">
        Açıklama
        <textarea name="description" rows="4" class="rounded-lg border-[#d8cdb9]">{{ old('description', $product->description) }}</textarea>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Ana Görsel Yolu
        <input name="main_image" value="{{ old('main_image', $product->main_image) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Ambalaj Tipi
        <input name="package_type" value="{{ old('package_type', $product->package_type) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Litre
        <input name="volume_liter" type="number" step="0.001" min="0" value="{{ old('volume_liter', $product->volume_liter) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Stok Adedi
        <input name="stock_quantity" type="number" min="0" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Stok Durumu
        <select name="stock_status" class="rounded-lg border-[#d8cdb9]" required>
            @foreach ($stockStatuses as $status)
                <option value="{{ $status->value }}" @selected($currentStockStatus === $status->value)>{{ $status->value }}</option>
            @endforeach
        </select>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Sıra
        <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="flex items-center gap-2 text-sm font-semibold">
        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $product->is_active ?? true))>
        Aktif
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button class="rounded-lg bg-[#35580b] px-5 py-2.5 text-sm font-bold text-white">Kaydet</button>
    <a href="{{ route('admin.products.index') }}" class="rounded-lg border border-[#d8cdb9] bg-white px-5 py-2.5 text-sm font-bold">Vazgeç</a>
</div>
