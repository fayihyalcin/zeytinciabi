@csrf

<div class="grid gap-4 md:grid-cols-2">
    <label class="grid gap-1 text-sm font-semibold">
        Kategori Adı
        <input name="name" value="{{ old('name', $category->name) }}" class="rounded-lg border-[#d8cdb9]" required>
        @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Slug
        <input name="slug" value="{{ old('slug', $category->slug) }}" class="rounded-lg border-[#d8cdb9]" placeholder="Boşsa otomatik">
        @error('slug') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="grid gap-1 text-sm font-semibold md:col-span-2">
        Açıklama
        <textarea name="description" rows="3" class="rounded-lg border-[#d8cdb9]">{{ old('description', $category->description) }}</textarea>
    </label>
    <label class="grid gap-1 text-sm font-semibold">
        Sıra
        <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="rounded-lg border-[#d8cdb9]">
    </label>
    <label class="flex items-center gap-2 text-sm font-semibold">
        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $category->is_active ?? true))>
        Aktif
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button class="rounded-lg bg-[#35580b] px-5 py-2.5 text-sm font-bold text-white">Kaydet</button>
    <a href="{{ route('admin.product-categories.index') }}" class="rounded-lg border border-[#d8cdb9] bg-white px-5 py-2.5 text-sm font-bold">Vazgeç</a>
</div>
