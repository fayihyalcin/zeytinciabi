<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bayi Başvurusu | Zeytinci Abi</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f6f1e8] text-[#172511] antialiased">
        <main class="min-h-screen overflow-hidden bg-[radial-gradient(circle_at_82%_10%,rgba(82,116,30,.16),transparent_28%),linear-gradient(135deg,#fffdf8_0%,#f6f1e8_58%,#eef3de_100%)]">
            <div class="mx-auto grid min-h-screen max-w-7xl gap-8 px-4 py-6 lg:grid-cols-[0.88fr_1.12fr] lg:px-8">
                <section class="relative hidden min-h-[680px] rounded-lg border border-[#e4d8bf] bg-[#10270f] p-8 text-white shadow-2xl lg:block">
                    <div class="absolute inset-0 rounded-lg bg-[radial-gradient(circle_at_22%_18%,rgba(194,154,49,.24),transparent_24%),radial-gradient(circle_at_80%_72%,rgba(107,142,45,.28),transparent_30%)]"></div>
                    <div class="relative z-10 flex h-full flex-col justify-between">
                        <div>
                            <a href="/" class="inline-flex items-center">
                                <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png') }}" alt="Zeytinci Abi" class="h-24 w-auto">
                            </a>

                            <h1 class="mt-14 max-w-xl font-serif text-6xl font-bold leading-[1.02]">
                                Stok almadan satışa başla.
                            </h1>
                            <p class="mt-5 max-w-lg text-lg leading-8 text-white/72">
                                İlk başvuru için sadece temel bilgileri alıyoruz. Firma, adres ve ödeme bilgilerini onaydan sonra panelinden tamamlayabilirsin.
                            </p>
                        </div>

                        <div class="grid gap-3">
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Başlangıç</p>
                                <strong class="mt-2 block font-serif text-3xl">Sermayesiz</strong>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Operasyon</p>
                                <strong class="mt-2 block font-serif text-3xl">Kargo Bizden</strong>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-white/8 p-4">
                                <p class="text-sm text-white/60">Takip</p>
                                <strong class="mt-2 block font-serif text-3xl">Panelden Anlık</strong>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto flex w-full max-w-2xl items-center py-4">
                    <div class="w-full rounded-lg border border-[#e3d8c5] bg-white/94 p-5 shadow-xl backdrop-blur sm:p-7">
                        <div class="mb-7 text-center lg:hidden">
                            <a href="/" class="inline-block">
                                <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png') }}" alt="Zeytinci Abi" class="mx-auto h-20 w-auto">
                            </a>
                        </div>

                        <div class="mb-7">
                            <p class="text-sm font-bold uppercase tracking-wide text-[#52741e]">Bayi Başvurusu</p>
                            <h2 class="mt-2 font-serif text-4xl font-bold">Başvurunu gönder</h2>
                            <p class="mt-2 text-sm leading-6 text-[#6b6d65]">Temel bilgilerini bırak, merkez ekip başvurunu incelesin. Onaydan sonra bayi panelinden firma ve ödeme bilgilerini tamamlayabilirsin.</p>
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <a href="{{ route('auth.google') }}" class="mb-5 flex items-center justify-center gap-3 rounded-lg border border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-sm font-bold text-[#2f352b] shadow-sm transition hover:border-[#52741e] hover:bg-[#fbf8f2]">
                            <span class="grid h-7 w-7 place-items-center rounded-full bg-white font-serif text-lg text-[#b87900] shadow-sm">G</span>
                            Google ile kayıt ol
                        </a>

                        <div class="mb-5 flex items-center gap-3 text-xs font-bold uppercase tracking-wide text-[#9a927f]">
                            <span class="h-px flex-1 bg-[#e3d8c5]"></span>
                            <span>veya form ile</span>
                            <span class="h-px flex-1 bg-[#e3d8c5]"></span>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="grid gap-4">
                            @csrf

                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    Yetkili Ad Soyad
                                    <input id="name" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </label>

                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    Bayi Görünen Adı
                                    <input id="display_name" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="text" name="display_name" value="{{ old('display_name') }}" required>
                                    <x-input-error :messages="$errors->get('display_name')" class="mt-1" />
                                </label>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    E-posta
                                    <input id="email" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="email" name="email" value="{{ old('email') }}" autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </label>

                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    Telefon
                                    <input id="phone" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                                </label>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    Şifre
                                    <input id="password" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="password" name="password" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </label>

                                <label class="grid gap-1 text-sm font-semibold text-[#2f352b]">
                                    Şifre Tekrar
                                    <input id="password_confirmation" class="rounded-lg border-[#d8cdb9] bg-[#fffdf8] px-4 py-3 text-base shadow-sm focus:border-[#52741e] focus:ring-[#52741e]" type="password" name="password_confirmation" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                </label>
                            </div>

                            <div class="rounded-lg border border-[#e3d8c5] bg-[#fbf8f2] p-4 text-sm leading-6 text-[#5f635d]">
                                Firma adı, vergi no, il, ilçe, adres ve IBAN bilgilerini başvurun onaylandıktan sonra panelindeki Profilim alanından dolduracaksın.
                            </div>

                            <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">
                                <a class="text-sm font-bold text-[#52741e] underline-offset-4 hover:underline" href="{{ route('login') }}">
                                    Zaten kayıtlı mısınız?
                                </a>
                                <button class="rounded-lg bg-[#35580b] px-6 py-3.5 text-center text-sm font-bold text-white shadow-lg shadow-[#35580b]/20 transition hover:bg-[#52741e]" type="submit">
                                    Bayi Başvurusu Yap
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
