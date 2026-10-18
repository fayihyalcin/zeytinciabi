@extends('layouts.dealer')

@section('title', 'Siparişlerim')

@section('content')
<section class="welcome">
    <div>
        <h1>Siparişlerim <span class="leaf-mark">•</span></h1>
        <p>Müşterilerinden gelen siparişleri ve operasyon durumlarını takip et.</p>
    </div>
</section>

<section class="card p-5">
    <form method="GET" class="mb-5 grid gap-3 lg:grid-cols-[1fr_220px_auto]">
        <input name="q" value="{{ request('q') }}" placeholder="Sipariş no, müşteri veya telefon ara" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        <select name="status" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
            <option value="">Tüm durumlar</option>
            @foreach($statuses as $status)
                <option value="{{ $status->value }}" @selected($activeStatus === $status->value)>{{ $status->value }}</option>
            @endforeach
        </select>
        <button class="create-btn justify-center" type="submit">Filtrele</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[840px] text-left text-sm">
            <thead class="text-[#6b6d65]">
                <tr>
                    <th class="border-b border-[#e6dccb] py-3">Sipariş</th>
                    <th class="border-b border-[#e6dccb] py-3">Müşteri</th>
                    <th class="border-b border-[#e6dccb] py-3">Landing</th>
                    <th class="border-b border-[#e6dccb] py-3">Tutar</th>
                    <th class="border-b border-[#e6dccb] py-3">Kar</th>
                    <th class="border-b border-[#e6dccb] py-3">Durum</th>
                    <th class="border-b border-[#e6dccb] py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="border-b border-[#f0e8d9] py-3 font-bold">{{ $order->order_number }}</td>
                        <td class="border-b border-[#f0e8d9] py-3">{{ $order->customer_name }}<br><small class="text-[#6b6d65]">{{ $order->customer_phone }}</small></td>
                        <td class="border-b border-[#f0e8d9] py-3">{{ $order->landingPage?->title ?? '-' }}</td>
                        <td class="border-b border-[#f0e8d9] py-3">{{ number_format((float) $order->total_amount, 2, ',', '.') }} TL</td>
                        <td class="border-b border-[#f0e8d9] py-3">{{ number_format((float) $order->dealer_total_profit, 2, ',', '.') }} TL</td>
                        <td class="border-b border-[#f0e8d9] py-3"><x-status-badge :value="$order->order_status" /></td>
                        <td class="border-b border-[#f0e8d9] py-3 text-right"><a href="{{ route('dealer.orders.show', $order) }}" class="font-bold text-[#52741e]">Detay</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-8 text-center text-[#6b6d65]">Henüz sipariş yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div class="mt-5">{{ $orders->links() }}</div>
@endsection
