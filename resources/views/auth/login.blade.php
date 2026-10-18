<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Giriş | Zeytinci Abi</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f6f1e8] text-[#172511] antialiased">
        <main class="min-h-screen overflow-hidden bg-[radial-gradient(circle_at_82%_10%,rgba(82,116,30,.18),transparent_28%),linear-gradient(135deg,#fffdf8_0%,#f6f1e8_58%,#eef3de_100%)]">
            <div class="mx-auto grid min-h-screen max-w-7xl items-center gap-8 px-4 py-8 lg:grid-cols-[1.08fr_0.92fr] lg:px-8">
                <section class="relative hidden min-h-[680px] rounded-lg border border-[#e4d8bf] bg-[#10270f] p-8 text-white shadow-2xl lg:block">
                    <div class="absolute inset-0 rounded-lg bg-[radial-gradient(circle_at_22%_18%,rgba(194,154,49,.24),transparent_24%),radial-gradient(circle_at_80%_72%,rgba(107,142,45,.28),transparent_30%)]"></div>
                    <div class="relative z-10 flex h-full flex-col justify-between">
                        <div>
                            <a href="/" class="inline-flex items-center gap-3">
                                <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-panel.png') }}" alt="Zeytinci Abi" class="h-20 w-auto">
                                <span class="sr-only">Zeytinci Abi</span>
                            </a>

                            <h1 class="mt-16 max-w-xl font-serif text-6xl font-bold leading-[1.02]">
                                Sadece satışa odaklanan bayi paneli.
                            </h1>
                            <p class="mt-5 max-w-lg text-lg leading-8 text-white/72">
                                Ürünleri gör, landing page oluştur, siparişlerini takip et ve hak edişini tek ekranda izle.
                            </p>
                        </div>

                        <div class="grid gap-3 md:grid-cols-3">
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Başvuru</p>
                                <strong class="mt-2 block font-serif text-3xl">Hızlı</strong>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Sipariş</p>
                                <strong class="mt-2 block font-serif text-3xl">Merkezde</strong>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Kazanç</p>
                                <strong class="mt-2 block font-serif text-3xl">Anlık</strong>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full border border-white/10"></div>
                    <div class="absolute -bottom-16 right-10 h-56 w-56 rounded-full border border-[#c29a31]/30"></div>
                </section>

                <section class="mx-auto w-full max-w-md">
                    <div class="mb-8 text-center lg:hidden">
                        <a href="/" class="inline-block">
                            <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-panel.png') }}" alt="Zeytinci Abi" class="mx-auto h-24 w-auto">
                        </a>
                        <p class="mt-2 text-sm text-[#6b6d65]">Bayi ve yönetim paneli girişi</p>
                    </div>

                    <div class="rounded-lg border border-[#e3d8c5] bg-white/92 p-6 shadow-xl backdrop-blur sm:p-8">
                        <div class="mb-7">
                            <p class="text-sm font-bold uppercase tracking-wide text-[#52741e]">Panel Girişi</p>
                            <h2 class="mt-2 font-serif text-4xl font-bold">Hoş geldiniz</h2>
                            <p class="mt-2 text-sm leading-6 text-[#6b6d65]">Süper admin, operasyon ve bayi hesapları buradan giriş yapar.</p>
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <a href="{{ route('auth.google') }}" class="mb-5 flex items-center justify-center gap-3 rounded-lg border border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-sm font-bold text-[#2f352b] shadow-sm transition hover:border-[#52741e] hover:bg-[#fbf8f2]">
                            <span class="grid h-7 w-7 place-items-center rounded-full bg-white font-serif text-lg text-[#b87900] shadow-sm">G</span>
                            Google ile giriş yap
                        </a>

                        <div class="mb-5 flex items-center gap-3 text-xs font-bold uppercase tracking-wide text-[#9a927f]">
                            <span class="h-px flex-1 bg-[#e3d8c5]"></span>
                            <span>veya e-posta ile</span>
                            <span class="h-px flex-1 bg-[#e3d8c5]"></span>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="grid gap-4">
                            @csrf

                            <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                E-posta
                                <input
                                    id="email"
                                    class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="ornek@zeytinciabi.com"
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </label>

                            <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                Şifre
                                <input
                                    id="password"
                                    class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Şifreniz"
                                >
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </label>

                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <label for="remember_me" class="inline-flex items-center gap-2 text-sm font-semibold text-[#5f635d]">
                                    <input id="remember_me" type="checkbox" class="rounded border-[#d8cdb9] text-[#52741e] shadow-sm focus:ring-[#52741e]" name="remember">
                                    Beni hatırla
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm font-bold text-[#52741e] hover:text-[#35580b]" href="{{ route('password.request') }}">
                                        Şifremi unuttum
                                    </a>
                                @endif
                            </div>

                            <button class="mt-2 rounded-lg bg-[#35580b] px-5 py-3.5 text-center text-sm font-bold text-white shadow-lg shadow-[#35580b]/20 transition hover:bg-[#52741e]">
                                Giriş Yap
                            </button>
                        </form>

                        <div class="mt-6 rounded-lg border border-[#e7ddca] bg-[#fbf8f2] p-4 text-sm text-[#5f635d]">
                            Bayilik başvurusu yapmak için
                            <a href="{{ route('register') }}" class="font-bold text-[#52741e]">başvuru formuna geçin</a>.
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
