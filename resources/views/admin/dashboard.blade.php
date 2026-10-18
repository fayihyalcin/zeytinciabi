@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <section class="welcome">
        <div>
            <h1>Süper Admin Dashboard <span class="leaf-mark">🌿</span></h1>
            <p>Bayiler, siparişler, kazanç ve merkez operasyonunu buradan takip edebilirsin.</p>
        </div>
    </section>

    <section class="summary-row">
        <div class="card stat">
            <div class="stat-ico">@include('dealer.partials.icons.user')</div>
            <div>
                <h3>Toplam Bayi</h3>
                <strong>{{ $metrics['total_dealers'] }}</strong>
                <div class="subline">Tüm başvurular</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><circle cx="12" cy="12" r="9"></circle><path d="m8 12 3 3 5-6"></path></svg>
            </div>
            <div>
                <h3>Aktif Bayi</h3>
                <strong>{{ $metrics['active_dealers'] }}</strong>
                <div class="subline">Onaylı hesaplar</div>
            </div>
        </div>
        <div class="card stat gold">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 3"></path></svg>
            </div>
            <div>
                <h3>Bekleyen Başvuru</h3>
                <strong>{{ $metrics['pending_dealers'] }}</strong>
                <div class="subline">İnceleme bekliyor</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">@include('dealer.partials.icons.orders')</div>
            <div>
                <h3>Bugünkü Sipariş</h3>
                <strong>{{ $metrics['today_orders'] }}</strong>
                <div class="subline">Anlık operasyon</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">@include('dealer.partials.icons.truck')</div>
            <div>
                <h3>Toplam Sipariş</h3>
                <strong>{{ $metrics['total_orders'] }}</strong>
                <div class="subline">Platform toplamı</div>
            </div>
        </div>
        <div class="card stat gold">
            <div class="stat-ico">@include('dealer.partials.icons.wallet')</div>
            <div>
                <h3>Toplam Ciro</h3>
                <strong>{{ $metrics['total_revenue'] }}</strong>
                <div class="subline">Satış hacmi</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">@include('dealer.partials.icons.chart')</div>
            <div>
                <h3>Bayi Kazancı</h3>
                <strong>{{ $metrics['dealer_earnings'] }}</strong>
                <div class="subline">Hak ediş toplamı</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><ellipse cx="12" cy="6" rx="7" ry="3"></ellipse><path d="M5 6v4c0 1.7 3.1 3 7 3s7-1.3 7-3V6"></path><path d="M5 10v4c0 1.7 3.1 3 7 3s7-1.3 7-3v-4"></path></svg>
            </div>
            <div>
                <h3>Merkez Net Kazanç</h3>
                <strong>{{ $metrics['center_profit'] }}</strong>
                <div class="subline">Merkez payı</div>
            </div>
        </div>
    </section>

    <section class="grid-2">
        <div class="card status-card">
            <div class="card-head">
                <div class="card-title">Merkez Operasyon Özeti</div>
                <span class="chip green">Canlı</span>
            </div>
            <div class="status-grid">
                <div class="status-item yellow">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M8 3h8"></path><path d="M9 3v4l3 3 3-3V3"></path><path d="M9 21h6"></path><path d="M15 21v-4l-3-3-3 3v4"></path></svg>
                    <h4>Bekleyen</h4>
                    <strong>{{ $metrics['pending_dealers'] }}</strong>
                </div>
                <div class="status-item green">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"></circle><path d="m8 12 3 3 5-6"></path></svg>
                    <h4>Aktif Bayi</h4>
                    <strong>{{ $metrics['active_dealers'] }}</strong>
                </div>
                <div class="status-item blue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M12 3 4 7v10l8 4 8-4V7l-8-4Z"></path><path d="M4 7l8 4 8-4"></path><path d="M12 11v10"></path></svg>
                    <h4>Sipariş</h4>
                    <strong>{{ $metrics['total_orders'] }}</strong>
                </div>
                <div class="status-item purple">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M5 19V9"></path><path d="M12 19V5"></path><path d="M19 19v-7"></path><path d="M3 19h18"></path></svg>
                    <h4>Kazanç</h4>
                    <strong>{{ $metrics['dealer_earnings'] }}</strong>
                </div>
                <div class="status-item red">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M3 7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"></path><path d="M16 12h2"></path></svg>
                    <h4>Ödeme</h4>
                    <strong>0</strong>
                </div>
            </div>
        </div>

        <div class="card quick-card">
            <div class="card-head">
                <div class="card-title">Hızlı İşlemler</div>
            </div>
            <div class="quick-grid">
                <a href="{{ route('admin.dealers.pending') }}" class="quick-item">
                    <span class="qicon">@include('dealer.partials.icons.user')</span>
                    Başvuru İncele
                </a>
                <a href="{{ route('admin.products.create') }}" class="quick-item gold">
                    <span class="qicon">@include('dealer.partials.icons.bag')</span>
                    Ürün Ekle
                </a>
                <a href="{{ route('admin.product-prices.create') }}" class="quick-item">
                    <span class="qicon">@include('dealer.partials.icons.wallet')</span>
                    Fiyat Tanımla
                </a>
                <a href="{{ route('admin.orders.index') }}" class="quick-item gold">
                    <span class="qicon">@include('dealer.partials.icons.truck')</span>
                    Siparişleri Gör
                </a>
            </div>
        </div>
    </section>

    <section class="card orders-card" style="margin-top:12px">
        <div class="card-head">
            <div class="card-title">Yönetim Kısayolları</div>
            <span class="chip blue">Süper Admin</span>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Alan</th>
                        <th>Amaç</th>
                        <th>Durum</th>
                        <th>Bağlantı</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Bayiler</td><td>Başvuru, onay ve bayi profilleri</td><td><span class="chip green">Aktif</span></td><td><a href="{{ route('admin.dealers.index') }}">Aç</a></td></tr>
                    <tr><td>Ürünler</td><td>Katalog ve ürün görselleri</td><td><span class="chip green">Aktif</span></td><td><a href="{{ route('admin.products.index') }}">Aç</a></td></tr>
                    <tr><td>Fiyatlar</td><td>Bayi alış, önerilen ve minimum satış fiyatı</td><td><span class="chip green">Aktif</span></td><td><a href="{{ route('admin.product-prices.index') }}">Aç</a></td></tr>
                    <tr><td>Raporlar</td><td>Operasyon, kazanç ve performans izleme</td><td><span class="chip yellow">Hazırlanıyor</span></td><td><a href="{{ route('admin.reports.index') }}">Aç</a></td></tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
