@extends('layouts.admin')

@section('title', 'Ürünler')
@section('page_title', 'Ürünler')
@section('page_subtitle', 'Satılabilir ürün kataloğu')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.products.create') }}" class="rounded-lg bg-[#35580b] px-4 py-2 text-sm font-bold text-white">Yeni Ürün</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Ürün</th><th class="p-3">Kategori</th><th class="p-3">SKU</th><th class="p-3">Stok</th><th class="p-3">Durum</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category?->name ?? '-' }}</td>
                        <td class="p-3">{{ $product->sku ?? '-' }}</td>
                        <td class="p-3">{{ $product->stock_quantity }} <x-status-badge :value="$product->stock_status" /></td>
                        <td class="p-3"><x-status-badge :value="$product->is_active ? 'active' : 'passive'" /></td>
                        <td class="p-3 text-right"><a class="font-bold text-[#35580b]" href="{{ route('admin.products.edit', $product) }}">Düzenle</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-[#6b6d65]">Henüz ürün yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
@endsection
