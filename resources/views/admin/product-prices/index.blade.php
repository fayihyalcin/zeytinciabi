@extends('layouts.admin')

@section('title', 'Fiyatlar')
@section('page_title', 'Ürün Fiyatları')
@section('page_subtitle', 'Bayi alış, minimum ve önerilen satış fiyatları')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.product-prices.create') }}" class="rounded-lg bg-[#35580b] px-4 py-2 text-sm font-bold text-white">Yeni Fiyat</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Ürün</th><th class="p-3">Bayi Alış</th><th class="p-3">Min</th><th class="p-3">Önerilen</th><th class="p-3">Durum</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($prices as $price)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $price->product?->name }}</td>
                        <td class="p-3">{{ number_format((float) $price->dealer_buy_price, 2, ',', '.') }} {{ $price->currency }}</td>
                        <td class="p-3">{{ number_format((float) $price->min_sale_price, 2, ',', '.') }} {{ $price->currency }}</td>
                        <td class="p-3">{{ number_format((float) $price->suggested_sale_price, 2, ',', '.') }} {{ $price->currency }}</td>
                        <td class="p-3"><x-status-badge :value="$price->is_active ? 'active' : 'passive'" /></td>
                        <td class="p-3 text-right"><a class="font-bold text-[#35580b]" href="{{ route('admin.product-prices.edit', $price) }}">Düzenle</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-[#6b6d65]">Henüz fiyat yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $prices->links() }}</div>
@endsection
