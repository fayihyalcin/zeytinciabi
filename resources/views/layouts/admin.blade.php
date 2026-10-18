<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Süper Admin') | Zeytinci Abi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{
            --bg:#f6f1e8;
            --card:#fffdf8;
            --line:#e6dccb;
            --text:#22251f;
            --muted:#6b6d65;
            --green:#52741e;
            --green-soft:#eef3de;
            --gold:#c29a31;
            --gold-soft:#faf1d8;
            --shadow:0 10px 30px rgba(61,67,40,.08);
        }
        *{box-sizing:border-box}
        html,body{margin:0;padding:0;background:#f6f1e8;font-family:Inter,Arial,Helvetica,sans-serif;color:var(--text)}
        button,input{font:inherit}
        button{cursor:pointer}
        .app{width:100%;min-height:100vh;background:linear-gradient(180deg,#f8f4ec 0%,#f6f1e8 100%);overflow:hidden;position:relative}
        .sidebar{position:fixed;left:0;top:0;bottom:0;width:250px;background:radial-gradient(circle at 20% 10%, #1b4a17 0%, #0f250f 40%, #071408 100%);color:#fff;padding:16px 12px 18px;border-radius:0 18px 18px 0;display:flex;flex-direction:column;overflow:hidden}
        .logo-wrap{display:flex;flex-direction:column;align-items:center;padding-top:8px;color:inherit;text-decoration:none}
        .panel-logo{width:142px;height:auto;display:block;filter:drop-shadow(0 10px 18px rgba(0,0,0,.18))}
        .brand-line{width:88px;height:2px;background:#9a7c2f;margin:8px auto 8px;border-radius:999px;position:relative}
        .brand-line:after{content:"";width:6px;height:6px;border-radius:50%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);background:#b79334;box-shadow:0 0 0 6px #12320f}
        .panel-role{font-size:12px;font-weight:700;color:rgba(255,255,255,.7);letter-spacing:.08em;text-transform:uppercase}
        .menu{margin-top:18px;display:flex;flex:1 1 auto;min-height:0;flex-direction:column;gap:6px;overflow-y:auto;padding-right:3px;padding-bottom:12px}
        .menu::-webkit-scrollbar{width:4px}
        .menu::-webkit-scrollbar-thumb{background:rgba(255,255,255,.22);border-radius:999px}
        .menu a{display:flex;align-items:center;gap:12px;color:#f5f3eb;text-decoration:none;min-height:42px;padding:10px 12px;border-radius:14px;font-size:13px;font-weight:600;border:1px solid transparent}
        .menu a.active{background:linear-gradient(180deg,rgba(100,125,44,.32),rgba(79,110,30,.22));border-color:rgba(223,224,189,.25);box-shadow:inset 0 0 0 1px rgba(255,255,255,.05)}
        .iconbox{width:22px;height:22px;display:grid;place-items:center;color:#f6f3e8;opacity:.95;flex:0 0 22px}
        .iconbox svg{width:18px;height:18px;stroke:currentColor}
        .sidebar-bottom{position:static;flex:0 0 auto;padding:14px 14px 0;text-align:center}
        .olive-decor{font-size:42px;line-height:1;filter:saturate(.8)}
        .sidebar-note{margin-top:8px;font-family:Georgia,"Times New Roman",serif;font-size:16px;line-height:1.22;color:#ece6d5}
        .sidebar-note small{display:block;font-size:12px;opacity:.85;margin-top:7px;font-family:Inter,Arial,sans-serif}
        .main{margin-left:250px;min-height:100vh;position:relative;transition:margin-left .25s ease}
        .topbar{height:76px;display:flex;align-items:center;justify-content:space-between;padding:0 20px 0 24px;background:rgba(253,250,243,.86);border-bottom:1px solid var(--line);position:sticky;top:0;z-index:20}
        .sidebar-toggle{width:44px;height:44px;border:1px solid var(--line);border-radius:14px;background:#fffdf8;display:grid;place-items:center;color:#263119;box-shadow:0 8px 18px rgba(39,67,15,.08);flex:0 0 44px}
        .sidebar-toggle svg{width:22px;height:22px;stroke:currentColor}
        .mobile-backdrop{display:none;position:fixed;inset:0;background:rgba(14,23,31,.45);z-index:80}
        .search{width:390px;height:46px;border:1px solid var(--line);background:#fffdf8;border-radius:16px;display:flex;align-items:center;padding:0 18px;gap:12px;color:#898b85;box-shadow:0 2px 10px rgba(0,0,0,.02) inset}
        .search input{border:none;outline:none;background:transparent;font-size:16px;flex:1;color:#5d5f58;min-width:0}
        .top-right{display:flex;align-items:center;gap:18px}
        .notif{position:relative;width:40px;height:40px;display:grid;place-items:center;color:#30352d}
        .notif svg{width:26px;height:26px;stroke:#30352d}
        .notif span{position:absolute;right:2px;top:2px;width:22px;height:22px;border-radius:50%;display:grid;place-items:center;background:#365c18;color:#fff;font-size:12px;font-weight:700;border:3px solid #f7f3ea}
        .profile{display:flex;align-items:center;gap:12px}
        .avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(180deg,#d6c1a0,#b7855e);display:grid;place-items:center;overflow:hidden;border:3px solid #fff;box-shadow:var(--shadow)}
        .avatar span{font-size:21px;font-weight:800}
        .profile-meta{line-height:1.1}
        .profile-meta strong{font-size:14px;display:block}
        .profile-meta small{font-size:14px;color:#5f635d}
        .create-btn{height:48px;padding:0 18px;border-radius:16px;background:linear-gradient(180deg,#5f7f25,#4e6f1d);border:none;color:#fff;font-size:14px;font-weight:800;display:flex;align-items:center;gap:10px;box-shadow:0 12px 24px rgba(77,111,29,.22);text-decoration:none}
        .create-btn.logout{background:#fffdf8;color:#3f463b;border:1px solid var(--line);box-shadow:none;padding:0 16px}
        .create-btn .plus{width:26px;height:26px;border-radius:50%;border:2px solid rgba(255,255,255,.85);display:grid;place-items:center;font-size:20px;line-height:1}
        .content{padding:22px}
        .welcome{display:flex;align-items:flex-end;justify-content:space-between;padding:6px 12px 12px}
        .welcome h1{font-family:Georgia,"Times New Roman",serif;font-size:38px;line-height:1;margin:0;color:#1f241b}
        .welcome p{margin:8px 0 0;color:#676b63;font-size:15px}
        .leaf-mark{font-size:24px;margin-left:10px;color:#79973a}
        .summary-row{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-top:8px}
        .card{background:var(--card);border:1px solid var(--line);border-radius:22px;box-shadow:var(--shadow)}
        .stat{padding:14px 16px 14px 14px;display:flex;gap:14px;align-items:center;min-height:96px}
        .stat-ico{width:44px;height:44px;border-radius:16px;display:grid;place-items:center;background:var(--green-soft);color:var(--green);flex:0 0 44px}
        .stat.gold .stat-ico{background:var(--gold-soft);color:var(--gold)}
        .stat-ico svg{width:22px;height:22px;stroke:currentColor}
        .stat h3{margin:0 0 6px;font-size:14px;font-weight:500;color:#474c45}
        .stat strong{display:block;font-family:Georgia,"Times New Roman",serif;font-size:24px;color:#161b15;line-height:1.1}
        .subline{display:flex;align-items:center;gap:8px;margin-top:6px;font-size:13px;color:#595d57}
        .grid-2{display:grid;grid-template-columns:minmax(0,1.35fr) minmax(390px,.95fr);gap:12px;margin-top:12px;align-items:start}
        .card-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
        .card-title{font-family:Georgia,"Times New Roman",serif;font-size:18px;color:#232920}
        .status-card,.quick-card,.orders-card{padding:16px 18px 18px;position:relative;overflow:hidden}
        .status-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:9px;margin-top:18px}
        .status-item{border-radius:16px;padding:13px 8px 12px;border:1px solid var(--line);text-align:center}
        .status-item h4{margin:7px 0 8px;font-size:13px;color:#33372f;font-weight:600}
        .status-item strong{display:block;font-family:Georgia,"Times New Roman",serif;font-size:21px;line-height:1;color:#22251f}
        .status-item svg{width:26px;height:26px}
        .status-item.yellow{background:#fbf3df;color:#c18d1f}
        .status-item.blue{background:#eef5fc;color:#4f83c1}
        .status-item.purple{background:#f1eef8;color:#6f68b7}
        .status-item.green{background:#eef5e6;color:#628428}
        .status-item.red{background:#fbeeea;color:#cb5845}
        .quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px}
        .quick-item{border:1px solid var(--line);background:#f8f4e7;border-radius:16px;padding:18px 14px;min-height:88px;display:flex;align-items:center;gap:12px;font-weight:700;color:#30342d;text-decoration:none}
        .quick-item .qicon{width:40px;height:40px;display:grid;place-items:center;color:#5b7a20;flex:0 0 40px}
        .quick-item.gold .qicon{color:#c29a31}
        .quick-item svg{width:22px;height:22px;stroke:currentColor}
        .table-scroll{width:100%;overflow:auto}
        .admin-table{width:100%;border-collapse:collapse;font-size:14px;min-width:720px}
        .admin-table th,.admin-table td{padding:10px 6px;border-bottom:1px solid #f0e8d9;text-align:left;white-space:nowrap}
        .admin-table th{font-weight:700;color:#5c615a;font-size:13px}
        .chip{display:inline-block;padding:6px 12px;border-radius:999px;font-size:12px;font-weight:800}
        .chip.green{background:#e5f0d8;color:#628428}
        .chip.yellow{background:#f9ecbf;color:#a7811e}
        .chip.blue{background:#dcebfc;color:#4f82bf}
        .session-status{margin:0 12px 12px;border:1px solid #d7bd83;background:#fff8e8;border-radius:16px;padding:12px 14px;color:#51651e;font-weight:700}
        .olive-right-top,.olive-right-bottom{position:absolute;right:-8px;pointer-events:none;color:#d9ddc8;opacity:.55;font-size:92px;line-height:1}
        .olive-right-top{top:370px;transform:rotate(-8deg)}
        .olive-right-bottom{bottom:16px;transform:rotate(10deg)}
        .app.sidebar-collapsed .sidebar{width:82px;padding-left:10px;padding-right:10px}
        .app.sidebar-collapsed .main{margin-left:82px}
        .app.sidebar-collapsed .panel-logo{width:58px}
        .app.sidebar-collapsed .panel-role,.app.sidebar-collapsed .brand-line,.app.sidebar-collapsed .menu a span:not(.iconbox),.app.sidebar-collapsed .sidebar-bottom{display:none!important}
        .app.sidebar-collapsed .menu{margin-top:26px;align-items:center;gap:9px!important}
        .app.sidebar-collapsed .menu a{width:50px!important;height:46px!important;justify-content:center!important;padding:0!important;gap:0!important;border-radius:14px!important;font-size:0!important;color:transparent!important;overflow:hidden;white-space:nowrap}
        .app.sidebar-collapsed .iconbox{margin:0;color:#f5f3eb!important}
        @media(max-width:1280px){
            .summary-row{grid-template-columns:repeat(2,minmax(0,1fr))}
            .grid-2{grid-template-columns:1fr}
            .status-grid{grid-template-columns:repeat(5,minmax(110px,1fr));overflow:auto;padding-bottom:4px}
        }
        @media(max-width:980px){
            .app{overflow-x:hidden}
            .sidebar{position:fixed;left:0;top:0;bottom:0;width:280px!important;transform:translateX(-105%);border-radius:0 22px 22px 0;z-index:100;transition:transform .25s ease;overflow:auto}
            .app.sidebar-open .sidebar{transform:translateX(0)}
            .app.sidebar-open .mobile-backdrop{display:block}
            .main{margin-left:0!important;min-height:100vh}
            .topbar{position:sticky;top:0;z-index:70;height:auto;min-height:72px;padding:12px 14px;display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:14px}
            .search{width:100%;height:44px}
            .top-right{justify-content:flex-end;gap:14px}
            .profile-meta,.notif{display:none}
            .create-btn{height:44px;padding:0 14px}
            .content{padding:18px 14px 24px}
            .welcome h1{font-size:34px}
            .sidebar .panel-role,.sidebar .brand-line,.sidebar .menu a span:not(.iconbox),.sidebar .sidebar-bottom{display:block!important}
            .sidebar .menu a{width:auto!important;height:auto!important;justify-content:flex-start!important;padding:10px 12px!important;gap:12px!important;font-size:13px!important;color:#f5f3eb!important}
            .sidebar .panel-logo{width:142px}
        }
        @media(max-width:720px){
            .topbar{grid-template-columns:auto 1fr;gap:10px}
            .top-right{grid-column:1 / -1;width:100%;justify-content:space-between}
            .search{grid-column:2}
            .create-btn{flex:1;justify-content:center}
            .summary-row{grid-template-columns:1fr}
            .status-grid{grid-template-columns:1fr}
            .quick-grid{grid-template-columns:1fr}
            .welcome{display:block}
            .welcome h1{font-size:30px}
            .sidebar{width:84vw!important;max-width:320px}
            .admin-table{min-width:0;font-size:12px}
            .admin-table th,.admin-table td{white-space:normal;vertical-align:top}
            .admin-table th:nth-child(3),.admin-table td:nth-child(3){display:none}
        }
    </style>
    @stack('styles')
</head>
<body>
@php
    $adminMenu = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'grid', 'active' => 'admin.dashboard'],
        ['label' => 'Bayiler', 'route' => 'admin.dealers.index', 'icon' => 'user', 'active' => 'admin.dealers.index'],
        ['label' => 'Bekleyen Başvurular', 'route' => 'admin.dealers.pending', 'icon' => 'orders', 'active' => 'admin.dealers.pending'],
        ['label' => 'Kategoriler', 'route' => 'admin.product-categories.index', 'icon' => 'page', 'active' => 'admin.product-categories.*'],
        ['label' => 'Ürünler', 'route' => 'admin.products.index', 'icon' => 'bag', 'active' => 'admin.products.*'],
        ['label' => 'Fiyatlar', 'route' => 'admin.product-prices.index', 'icon' => 'wallet', 'active' => 'admin.product-prices.*'],
        ['label' => 'Siparişler', 'route' => 'admin.orders.index', 'icon' => 'truck', 'active' => 'admin.orders.*'],
        ['label' => 'Hak Edişler', 'route' => 'admin.earnings.index', 'icon' => 'chart', 'active' => 'admin.earnings.*'],
        ['label' => 'Ödemeler', 'route' => 'admin.payouts.index', 'icon' => 'wallet', 'active' => 'admin.payouts.*'],
        ['label' => 'Raporlar', 'route' => 'admin.reports.index', 'icon' => 'chart', 'active' => 'admin.reports.*'],
        ['label' => 'Ayarlar', 'route' => 'admin.settings.index', 'icon' => 'page', 'active' => 'admin.settings.*'],
    ];
@endphp
<div class="app" id="app">
    <div class="mobile-backdrop" id="mobileBackdrop"></div>
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="logo-wrap">
            <img class="panel-logo" src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-panel.png') }}" alt="Zeytinci Abi">
            <div class="brand-line"></div>
            <div class="panel-role">Süper Admin</div>
        </a>

        <nav class="menu">
            @foreach($adminMenu as $item)
                <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['active']) ? 'active' : '' }}">
                    <span class="iconbox">@include('dealer.partials.icons.'.$item['icon'])</span>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="sidebar-bottom">
            <div class="olive-decor">🌿</div>
            <div class="sidebar-note">Merkez operasyon,<br>tek panelde.
                <small>──────── ✦ ────────</small>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menüyü aç/kapat" type="button">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16"></path><path d="M4 12h16"></path><path d="M4 18h16"></path></svg>
            </button>
            <div class="search">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#6e726b" stroke-width="1.8"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path></svg>
                <input type="text" placeholder="Ara (bayi, sipariş, ürün...)" />
            </div>
            <div class="top-right">
                <div class="notif">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path d="M18 8a6 6 0 1 0-12 0v5l-2 2h16l-2-2V8Z"></path><path d="M10 19a2 2 0 0 0 4 0"></path></svg>
                    <span>3</span>
                </div>
                <div class="profile">
                    <div class="avatar"><span>{{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}</span></div>
                    <div class="profile-meta"><strong>{{ auth()->user()->name }}</strong><small>Süper Admin</small></div>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4c5047" stroke-width="2"><path d="m6 9 6 6 6-6"></path></svg>
                </div>
                <a href="{{ route('admin.products.create') }}" class="create-btn"><span class="plus">+</span> Yeni Ürün</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="create-btn logout" type="submit">Çıkış</button>
                </form>
            </div>
        </div>

        <div class="content">
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            @yield('content')
        </div>

        <div class="olive-right-top">🌿</div>
        <div class="olive-right-bottom">🌿</div>
    </main>
</div>

<script>
    (function(){
        const app = document.getElementById('app');
        const toggle = document.getElementById('sidebarToggle');
        const backdrop = document.getElementById('mobileBackdrop');

        function isMobile(){
            return window.matchMedia('(max-width: 980px)').matches;
        }

        function closeMobile(){
            app.classList.remove('sidebar-open');
        }

        toggle?.addEventListener('click', function(){
            if(isMobile()){
                app.classList.toggle('sidebar-open');
            }else{
                app.classList.toggle('sidebar-collapsed');
                localStorage.setItem('zeytinciAdminSidebarCollapsed', app.classList.contains('sidebar-collapsed') ? '1' : '0');
            }
        });

        backdrop?.addEventListener('click', closeMobile);

        document.querySelectorAll('.sidebar .menu a').forEach(link => {
            link.addEventListener('click', () => {
                if(isMobile()) closeMobile();
            });
        });

        if(!isMobile() && localStorage.getItem('zeytinciAdminSidebarCollapsed') === '1'){
            app.classList.add('sidebar-collapsed');
        }

        window.addEventListener('resize', () => {
            if(!isMobile()){
                app.classList.remove('sidebar-open');
            }else{
                app.classList.remove('sidebar-collapsed');
            }
        });
    })();
</script>
@stack('scripts')
</body>
</html>
