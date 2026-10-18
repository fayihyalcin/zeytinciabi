@csrf

<div class="grid gap-4 md:grid-cols-2">
    <label class="grid gap-1 text-sm font-semibold md:col-span-2">
        Ürün
        <select name="product_id" class="rounded-lg border-[#d8cdb9]" required>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" @selected(old('product_id', $price->product_id) == $product->id)>{{ $product->name }}</option>
            @endforeach
        </select>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Normal Satış
        <input name="normal_sale_price" type="number" step="0.01" min="0.01" value="{{ old('normal_sale_price', $price->normal_sale_price) }}" class="rounded-lg border-[#d8cdb9]" required>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Bayi Alış
        <input name="dealer_buy_price" type="number" step="0.01" min="0.01" value="{{ old('dealer_buy_price', $price->dealer_buy_price) }}" class="rounded-lg border-[#d8cdb9]" required>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Önerilen Satış
        <input name="suggested_sale_price" type="number" step="0.01" min="0.01" value="{{ old('suggested_sale_price', $price->suggested_sale_price) }}" class="rounded-lg border-[#d8cdb9]" required>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Minimum Satış
        <input name="min_sale_price" type="number" step="0.01" min="0.01" value="{{ old('min_sale_price', $price->min_sale_price) }}" class="rounded-lg border-[#d8cdb9]" required>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Maksimum Satış
        <input name="max_sale_price" type="number" step="0.01" value="{{ old('max_sale_price', $price->max_sale_price) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Para Birimi
        <input name="currency" maxlength="3" value="{{ old('currency', $price->currency ?? 'TRY') }}" class="rounded-lg border-[#d8cdb9]" required>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Başlangıç
        <input name="starts_at" type="datetime-local" value="{{ old('starts_at', optional($price->starts_at)->format('Y-m-d\TH:i')) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Bitiş
        <input name="ends_at" type="datetime-local" value="{{ old('ends_at', optional($price->ends_at)->format('Y-m-d\TH:i')) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="flex items-center gap-2 text-sm font-semibold">
        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $price->is_active ?? true))>
        Aktif
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button class="rounded-lg bg-[#35580b] px-5 py-2.5 text-sm font-bold text-white">Kaydet</button>
    <a href="{{ route('admin.product-prices.index') }}" class="rounded-lg border border-[#d8cdb9] bg-white px-5 py-2.5 text-sm font-bold">Vazgeç</a>
</div>
