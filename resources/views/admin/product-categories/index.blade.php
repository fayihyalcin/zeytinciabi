@extends('layouts.admin')

@section('title', 'Kategoriler')
@section('page_title', 'Ürün Kategorileri')
@section('page_subtitle', 'Katalog grupları ve görünürlük ayarları')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.product-categories.create') }}" class="rounded-lg bg-[#35580b] px-4 py-2 text-sm font-bold text-white">Yeni Kategori</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Ad</th><th class="p-3">Slug</th><th class="p-3">Ürün</th><th class="p-3">Durum</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $category->name }}</td>
                        <td class="p-3">{{ $category->slug }}</td>
                        <td class="p-3">{{ $category->products_count }}</td>
                        <td class="p-3"><x-status-badge :value="$category->is_active ? 'active' : 'passive'" /></td>
                        <td class="p-3 text-right"><a class="font-bold text-[#35580b]" href="{{ route('admin.product-categories.edit', $category) }}">Düzenle</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-[#6b6d65]">Henüz kategori yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
