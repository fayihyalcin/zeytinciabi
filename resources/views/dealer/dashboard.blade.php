@extends('layouts.dealer')

@section('title', 'Dashboard')
@section('page_title', 'Hoş geldin, '.$dealer->display_name)
@section('page_subtitle', 'Satış, landing page ve hak ediş durumun')

@section('content')
    <section class="welcome">
        <div>
            <h1>Hoş geldin, {{ $dealer->display_name }} <span class="leaf-mark">•</span></h1>
            <p>Satış, landing page ve hak ediş durumunu buradan takip edebilirsin.</p>
        </div>
    </section>

    <section class="summary-row">
        <article class="stat card"><div class="stat-ico">#</div><div><h3>Toplam Sipariş</h3><strong>{{ $metrics['total_orders'] }}</strong></div></article>
        <article class="stat card"><div class="stat-ico">+</div><div><h3>Bugünkü Sipariş</h3><strong>{{ $metrics['today_orders'] }}</strong></div></article>
        <article class="stat card gold"><div class="stat-ico">₺</div><div><h3>Toplam Ciro</h3><strong>{{ number_format((float) $metrics['total_revenue'], 2, ',', '.') }} TL</strong></div></article>
        <article class="stat card"><div class="stat-ico">%</div><div><h3>Toplam Kazanç</h3><strong>{{ number_format((float) $metrics['total_profit'], 2, ',', '.') }} TL</strong></div></article>
        <article class="stat card gold"><div class="stat-ico">✓</div><div><h3>Aktif Landing</h3><strong>{{ $metrics['active_landing_pages'] }}</strong></div></article>
    </section>

    <div class="grid-2">
        <section class="orders-card card">
            <div class="card-head">
                <h2 class="card-title">Son Siparişler</h2>
                <a href="{{ route('dealer.orders.index') }}" class="text-sm font-bold text-[#52741e]">Tümünü Gör</a>
            </div>
            <div class="hidden overflow-auto md:block">
                <table class="w-full text-left text-sm">
                    <thead class="text-[#6b6d65]">
                        <tr><th class="py-3">No</th><th>Müşteri</th><th>Tutar</th><th>Durum</th><th>Tarih</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                            <tr>
                                <td class="border-t border-[#f0e8d9] py-3 font-semibold"><a href="{{ route('dealer.orders.show', $order) }}" class="text-[#52741e]">{{ $order->order_number }}</a></td>
                                <td class="border-t border-[#f0e8d9] py-3">{{ $order->customer_name }}</td>
                                <td class="border-t border-[#f0e8d9] py-3">{{ number_format((float) $order->total_amount, 2, ',', '.') }} TL</td>
                                <td class="border-t border-[#f0e8d9] py-3"><x-status-badge :value="$order->order_status" /></td>
                                <td class="border-t border-[#f0e8d9] py-3">{{ $order->created_at->format('d.m.Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-8 text-center text-[#6b6d65]">Henüz sipariş yok.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="grid gap-3 md:hidden">
                @forelse ($recentOrders as $order)
                    <a href="{{ route('dealer.orders.show', $order) }}" class="rounded-2xl border border-[#f0e8d9] bg-[#fbf8f2] p-4 text-inherit no-underline">
                        <div class="flex items-center justify-between gap-3">
                            <strong>{{ $order->order_number }}</strong>
                            <x-status-badge :value="$order->order_status" />
                        </div>
                        <p class="mt-2 text-sm">{{ $order->customer_name }}</p>
                        <p class="mt-1 text-sm font-bold text-[#52741e]">{{ number_format((float) $order->total_amount, 2, ',', '.') }} TL</p>
                    </a>
                @empty
                    <p class="rounded-2xl border border-dashed border-[#d8cdb9] p-5 text-sm text-[#6b6d65]">Henüz sipariş yok.</p>
                @endforelse
            </div>
        </section>

        <section class="status-card card">
            <h2 class="card-title">Sipariş Durumları</h2>
            <div class="mt-4 grid gap-3">
                @foreach (['pending' => 'Bekleyen', 'confirmed' => 'Onaylı', 'preparing' => 'Hazırlanıyor', 'shipped' => 'Kargoda', 'delivered' => 'Teslim'] as $status => $label)
                    <div class="flex items-center justify-between rounded-2xl border border-[#eee4d7] bg-[#fbf8f2] px-4 py-3">
                        <span class="text-sm font-semibold">{{ $label }}</span>
                        <strong class="font-serif text-xl">{{ $statusCounts[$status] ?? 0 }}</strong>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="mt-4 grid gap-4 xl:grid-cols-2">
        <section class="lp-card card">
            <div class="card-head">
                <h2 class="card-title">Landing Sayfalarım</h2>
                <a href="{{ route('dealer.landing-pages.create') }}" class="text-sm font-bold text-[#52741e]">Yeni Landing</a>
            </div>
            <div class="grid gap-3">
                @forelse ($landingPages as $landingPage)
                    <a href="{{ route('dealer.landing-pages.edit', $landingPage) }}" class="flex items-center justify-between rounded-2xl border border-[#eee4d7] bg-[#fbf8f2] px-4 py-3 text-inherit no-underline">
                        <div>
                            <p class="font-semibold">{{ $landingPage->title }}</p>
                            <p class="text-xs text-[#6b6d65]">/lp/{{ $landingPage->slug }} · {{ $landingPage->orders_count }} sipariş</p>
                        </div>
                        <x-status-badge :value="$landingPage->is_active ? 'active' : 'passive'" />
                    </a>
                @empty
                    <p class="rounded-2xl border border-dashed border-[#d8cdb9] p-5 text-sm text-[#6b6d65]">Henüz landing page oluşturmadınız.</p>
                @endforelse
            </div>
        </section>

        <section class="quick-card card">
            <h2 class="card-title">Hızlı İşlemler</h2>
            <div class="quick-grid">
                <a href="{{ route('dealer.landing-pages.create') }}" class="quick-item"><span class="qicon">+</span>Landing Oluştur</a>
                <a href="{{ route('dealer.products.index') }}" class="quick-item gold"><span class="qicon">₺</span>Ürünleri Gör</a>
                <a href="{{ route('dealer.orders.index') }}" class="quick-item"><span class="qicon">#</span>Sipariş Takibi</a>
                <a href="{{ route('dealer.payouts.index') }}" class="quick-item gold"><span class="qicon">✓</span>Hak Edişler</a>
            </div>
        </section>
    </div>
@endsection
