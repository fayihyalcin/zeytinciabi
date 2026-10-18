@extends('layouts.admin')

@section('title', 'Siparişler')
@section('page_title', 'Siparişler')
@section('page_subtitle', 'Merkeze düşen tüm bayi siparişleri')

@section('content')
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">No</th><th class="p-3">Bayi</th><th class="p-3">Müşteri</th><th class="p-3">Tutar</th><th class="p-3">Durum</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $order->order_number }}</td>
                        <td class="p-3">{{ $order->dealer?->display_name }}</td>
                        <td class="p-3">{{ $order->customer_name }}<div class="text-xs text-[#6b6d65]">{{ $order->customer_phone }}</div></td>
                        <td class="p-3">{{ number_format((float) $order->total_amount, 2, ',', '.') }} TL</td>
                        <td class="p-3"><x-status-badge :value="$order->order_status" /></td>
                        <td class="p-3 text-right"><a class="font-bold text-[#35580b]" href="{{ route('admin.orders.show', $order) }}">Detay</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-[#6b6d65]">Henüz sipariş yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
@endsection
