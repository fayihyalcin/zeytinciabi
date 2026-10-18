@extends('layouts.dealer')

@section('title', 'Kargo Takip')

@section('content')
<section class="welcome">
    <div>
        <h1>Kargo Takip <span class="leaf-mark">•</span></h1>
        <p>Kargoya verilmiş siparişlerin takip bilgileri.</p>
    </div>
</section>

<section class="grid gap-4">
    @forelse($orders as $order)
        <article class="card p-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-serif text-2xl font-bold">{{ $order->order_number }}</h2>
                    <p class="text-sm text-[#6b6d65]">{{ $order->customer_name }} · {{ $order->cargoCompany?->name ?? 'Kargo firması yok' }}</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <x-status-badge :value="$order->order_status" />
                    @if($order->cargo_tracking_url)
                        <a href="{{ $order->cargo_tracking_url }}" target="_blank" class="create-btn">Takip Et</a>
                    @else
                        <span class="font-bold text-[#52741e]">{{ $order->cargo_tracking_number }}</span>
                    @endif
                </div>
            </div>
        </article>
    @empty
        <article class="card p-8 text-center text-[#6b6d65]">Henüz takip numarası girilmiş sipariş yok.</article>
    @endforelse
</section>

<div class="mt-5">{{ $orders->links() }}</div>
@endsection
