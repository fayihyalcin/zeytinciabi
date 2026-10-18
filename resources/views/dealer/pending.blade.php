@extends('layouts.dealer')

@section('title', 'Bayi Başvurusu')

@section('content')
    @php
        $dealer = auth()->user()->dealerProfile;
    @endphp

    <section class="welcome">
        <div>
            <h1>Başvurunuz inceleniyor <span class="leaf-mark">🌿</span></h1>
            <p>Onaylandığında bayi paneli, ürünler, landing page, sipariş takibi ve hak ediş alanları açılacak.</p>
        </div>
    </section>

    <section class="summary-row">
        <div class="card stat">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><path d="m20 6-11 11-5-5"></path></svg>
            </div>
            <div>
                <h3>Başvuru</h3>
                <strong>Alındı</strong>
                <div class="subline">{{ $dealer?->created_at?->format('d.m.Y') ?? 'Kayıt alındı' }}</div>
            </div>
        </div>
        <div class="card stat gold">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 3"></path></svg>
            </div>
            <div>
                <h3>İnceleme</h3>
                <strong>Devam Ediyor</strong>
                <div class="subline">Merkez ekip kontrolünde</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path d="M8 12h8"></path><path d="M12 8v8"></path></svg>
            </div>
            <div>
                <h3>Panel Erişimi</h3>
                <strong>Açılacak</strong>
                <div class="subline">Onay sonrası aktif</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">
                @include('dealer.partials.icons.page')
            </div>
            <div>
                <h3>Landing Page</h3>
                <strong>Hazır</strong>
                <div class="subline">Yetki bekliyor</div>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-ico">
                @include('dealer.partials.icons.orders')
            </div>
            <div>
                <h3>Sipariş Akışı</h3>
                <strong>Kapalı</strong>
                <div class="subline">Onay ile açılır</div>
            </div>
        </div>
    </section>

    <section class="grid-2">
        <div class="card status-card">
            <div class="card-head">
                <div class="card-title">Başvuru Süreci</div>
                @if ($dealer)
                    <x-status-badge :value="$dealer->status" />
                @endif
            </div>

            <div class="status-grid">
                <div class="status-item green">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"></circle><path d="m8 12 3 3 5-6"></path></svg>
                    <h4>Kayıt</h4>
                    <strong>OK</strong>
                </div>
                <div class="status-item yellow">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M8 3h8"></path><path d="M9 3v4l3 3 3-3V3"></path><path d="M9 21h6"></path><path d="M15 21v-4l-3-3-3 3v4"></path></svg>
                    <h4>İnceleme</h4>
                    <strong>Aktif</strong>
                </div>
                <div class="status-item blue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M12 3 4 7v10l8 4 8-4V7l-8-4Z"></path><path d="M4 7l8 4 8-4"></path><path d="M12 11v10"></path></svg>
                    <h4>Ürünler</h4>
                    <strong>Bekler</strong>
                </div>
                <div class="status-item purple">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path d="M4 9h16"></path></svg>
                    <h4>Landing</h4>
                    <strong>Bekler</strong>
                </div>
                <div class="status-item red">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M1 7h13v9H1z"></path><path d="M14 10h4l4 3v3h-3"></path><circle cx="5" cy="18" r="2"></circle><circle cx="18" cy="18" r="2"></circle></svg>
                    <h4>Sipariş</h4>
                    <strong>Kapalı</strong>
                </div>
            </div>

            @if ($dealer?->rejected_reason)
                <div class="notice" style="border-color:#efb8ad;background:#fff4f1;color:#9b3429">
                    Red nedeni: {{ $dealer->rejected_reason }}
                </div>
            @else
                <div class="notice">
                    Başvurunuz onaylandığında bu sayfa otomatik olarak bayi dashboard'una yönlenecek ve sol menüdeki tüm operasyon alanları aktif hale gelecek.
                </div>
            @endif
        </div>

        <aside class="card quick-card">
            <div class="card-head">
                <div class="card-title">Bayi Bilgileri</div>
            </div>

            @if ($dealer)
                <ul class="info-list">
                    <li><span>Bayi Adı</span><strong>{{ $dealer->display_name }}</strong></li>
                    <li><span>Başvuru Kodu</span><strong>{{ $dealer->dealer_code }}</strong></li>
                    <li><span>Konum</span><strong>{{ $dealer->city ?? '-' }} / {{ $dealer->district ?? '-' }}</strong></li>
                    <li><span>İletişim</span><strong>{{ $dealer->whatsapp_phone ?? auth()->user()->phone ?? auth()->user()->email }}</strong></li>
                </ul>
            @else
                <div class="notice">Bayi profiliniz henüz oluşturulmamış.</div>
            @endif

            <div class="quick-grid">
                <div class="quick-item">
                    <span class="qicon">@include('dealer.partials.icons.user')</span>
                    Profil doğrulama
                </div>
                <div class="quick-item gold">
                    <span class="qicon">@include('dealer.partials.icons.wallet')</span>
                    Hak ediş yetkisi
                </div>
            </div>
        </aside>
    </section>
@endsection
