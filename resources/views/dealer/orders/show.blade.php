@extends('layouts.dealer')

@section('title', $order->order_number)

@section('content')
<section class="welcome">
    <div>
        <h1>{{ $order->order_number }} <span class="leaf-mark">•</span></h1>
        <p>{{ $order->customer_name }} sipariş detayı.</p>
    </div>
    <a href="{{ route('dealer.orders.index') }}" class="create-btn logout">Listeye Dön</a>
</section>

<section class="grid gap-4 lg:grid-cols-[1.2fr_.8fr]">
    <article class="card p-5">
        <div class="flex items-start justify-between gap-4">
            <h2 class="font-serif text-2xl font-bold">Sipariş Bilgileri</h2>
            <x-status-badge :value="$order->order_status" />
        </div>
        <div class="mt-5 grid gap-3 sm:grid-cols-2">
            <p><strong>Müşteri:</strong> {{ $order->customer_name }}</p>
            <p><strong>Telefon:</strong> {{ $order->customer_phone }}</p>
            <p><strong>İl/İlçe:</strong> {{ $order->customer_city }} / {{ $order->customer_district }}</p>
            <p><strong>Landing:</strong> {{ $order->landingPage?->title ?? '-' }}</p>
            <p class="sm:col-span-2"><strong>Adres:</strong> {{ $order->customer_address }}</p>
            @if($order->customer_note)
                <p class="sm:col-span-2"><strong>Not:</strong> {{ $order->customer_note }}</p>
            @endif
        </div>
    </article>

    <article class="card p-5">
        <h2 class="font-serif text-2xl font-bold">Kargo</h2>
        <div class="mt-5 grid gap-3 text-sm">
            <p><strong>Firma:</strong> {{ $order->cargoCompany?->name ?? 'Henüz atanmadı' }}</p>
            <p><strong>Takip No:</strong> {{ $order->cargo_tracking_number ?? '-' }}</p>
            @if($order->cargo_tracking_url)
                <a href="{{ $order->cargo_tracking_url }}" target="_blank" class="font-bold text-[#52741e]">Kargo Takip Linki</a>
            @endif
        </div>
    </article>
</section>

<section class="card mt-4 p-5">
    <h2 class="font-serif text-2xl font-bold">Ürünler</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="w-full min-w-[720px] text-left text-sm">
            <thead class="text-[#6b6d65]"><tr><th class="py-3">Ürün</th><th>Adet</th><th>Satış</th><th>Kar</th><th>Toplam</th></tr></thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="border-t border-[#f0e8d9] py-3 font-bold">{{ $item->product_name_snapshot }}</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ $item->quantity }}</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ number_format((float) $item->sale_price_snapshot, 2, ',', '.') }} TL</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ number_format((float) $item->dealer_profit, 2, ',', '.') }} TL</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ number_format((float) $item->line_total, 2, ',', '.') }} TL</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
