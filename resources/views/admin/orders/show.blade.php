@extends('layouts.admin')

@section('title', 'Sipariş Detay')
@section('page_title', $order->order_number)
@section('page_subtitle', $order->customer_name.' - '.$order->customer_city)

@section('content')
    <div class="grid gap-4 xl:grid-cols-3">
        <section class="rounded-lg border border-[#e3d8c5] bg-white p-5 xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-bold">Sipariş Kalemleri</h2>
                <x-status-badge :value="$order->order_status" />
            </div>
            <table class="w-full text-left text-sm">
                <thead class="text-xs uppercase text-[#6b6d65]"><tr><th class="py-2">Ürün</th><th>Adet</th><th>Satış</th><th>Kazanç</th></tr></thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-t border-[#eee4d7]">
                            <td class="py-3 font-semibold">{{ $item->product_name_snapshot }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format((float) $item->line_total, 2, ',', '.') }} TL</td>
                            <td>{{ number_format((float) $item->dealer_profit, 2, ',', '.') }} TL</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="rounded-lg border border-[#e3d8c5] bg-white p-5">
            <h2 class="mb-4 text-lg font-bold">Müşteri ve Kargo</h2>
            <dl class="grid gap-3 text-sm">
                <div><dt class="text-[#6b6d65]">Bayi</dt><dd class="font-semibold">{{ $order->dealer?->display_name }}</dd></div>
                <div><dt class="text-[#6b6d65]">Müşteri</dt><dd class="font-semibold">{{ $order->customer_name }} / {{ $order->customer_phone }}</dd></div>
                <div><dt class="text-[#6b6d65]">Adres</dt><dd class="font-semibold">{{ $order->customer_address }}</dd></div>
                <div><dt class="text-[#6b6d65]">Ödeme</dt><dd><x-status-badge :value="$order->payment_status" /></dd></div>
                <div><dt class="text-[#6b6d65]">Kargo</dt><dd class="font-semibold">{{ $order->cargoCompany?->name ?? '-' }} {{ $order->cargo_tracking_number }}</dd></div>
                <div><dt class="text-[#6b6d65]">Toplam</dt><dd class="font-bold">{{ number_format((float) $order->total_amount, 2, ',', '.') }} TL</dd></div>
            </dl>
        </section>
    </div>
@endsection
