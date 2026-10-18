<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zeytinci Abi</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|libre-baskerville:700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="za-page">
            <header class="za-header">
                <a href="/" class="za-logo" aria-label="Zeytinci Abi ana sayfa">
                    <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png') }}" alt="Zeytinci Abi">
                </a>

                <nav class="za-nav" aria-label="Ana menü">
                    <a href="#nasil-calisir">Nasıl Çalışır?</a>
                    <a href="#kazanc">Kazanç</a>
                    <a href="#avantajlar">Avantajlar</a>
                    <a href="#sss">SSS</a>
                    <a href="{{ route('register') }}">Bayi Ol</a>
                </nav>

                <a href="{{ route('register') }}" class="za-header-cta">
                    <span class="za-icon-badge" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M12 12.4a4.1 4.1 0 1 0 0-8.2 4.1 4.1 0 0 0 0 8.2Z" fill="currentColor"/>
                            <path d="M4.7 20.1c.7-3.5 3.2-5.5 7.3-5.5s6.6 2 7.3 5.5c.1.5-.3.9-.8.9h-17c-.5 0-.9-.4-.8-.9Z" fill="currentColor"/>
                        </svg>
                    </span>
                    Hemen Bayi Ol
                </a>
            </header>

            <main>
                <section class="za-hero" aria-labelledby="hero-title">
                    <div class="za-hero-inner">
                        <div class="za-hero-copy">
                            <h1 id="hero-title">
                                Stok Yok, Kargo Yok,<br>
                                Depo Yok.<br>
                                <span>Sadece Sat,<br class="za-mobile-break"> Kazan.</span>
                            </h1>

                            <div class="za-title-rule" aria-hidden="true"></div>

                            <p>
                                Zeytinci Abi, zeytinyağı üreticileri ile internetten satış
                                yapmak isteyen bayileri buluşturur. Siz müşteri bulun,
                                siparişi biz hazırlayalım ve kargolayalım.
                            </p>

                            <div class="za-actions">
                                <a href="{{ route('register') }}" class="za-primary-btn">
                                    <span class="za-icon-badge" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M12 12.4a4.1 4.1 0 1 0 0-8.2 4.1 4.1 0 0 0 0 8.2Z" fill="currentColor"/>
                                            <path d="M4.7 20.1c.7-3.5 3.2-5.5 7.3-5.5s6.6 2 7.3 5.5c.1.5-.3.9-.8.9h-17c-.5 0-.9-.4-.8-.9Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Bayi Başvurusu Yap
                                </a>

                                <a href="#nasil-calisir" class="za-secondary-btn">
                                    <span aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="m10 8 6 4-6 4V8Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Nasıl Çalışır?
                                </a>
                            </div>

                            <div class="za-feature-chips" aria-label="Öne çıkan avantajlar">
                                <div class="za-chip">
                                    <span aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M20 4c-8.1.1-13.5 4-15.8 11.9-.4 1.4.8 2.7 2.2 2.3C14.7 16 19.5 10.7 20 4Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 19c2.2-3.8 4.9-6.5 8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    Sermayesiz Başlangıç
                                </div>
                                <div class="za-chip">
                                    <span aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M4 14.8V7.6l8-4 8 4v7.2" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                            <path d="M7 20V10h10v10" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                            <path d="M10 20v-5h4v5" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    Kargo Bizden
                                </div>
                                <div class="za-chip">
                                    <span aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.8"/>
                                            <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="M12 3.5V1.8M20.5 12h1.7M12 20.5v1.7M3.5 12H1.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    Kolay Kazanç
                                </div>
                            </div>
                        </div>

                        <div class="za-hero-art" aria-label="Üretici, bayi, kargo ve müşteri süreci">
                            <img class="za-decor za-decor-top" src="{{ asset('assets/zeytinci-abi/07_zeytin_dali_kose_dekor.png') }}" alt="">
                            <img class="za-decor za-decor-bottom" src="{{ asset('assets/zeytinci-abi/07_zeytin_dali_kose_dekor.png') }}" alt="">

                            <svg class="za-flow za-flow-producer-dealer" viewBox="0 0 150 180" aria-hidden="true">
                                <path d="M82 8 C 34 50, 28 102, 40 152" />
                                <path d="M28 141 40 158 53 139" />
                            </svg>
                            <svg class="za-flow za-flow-producer-cargo" viewBox="0 0 230 95" aria-hidden="true">
                                <path d="M10 36 C 70 18, 134 20, 204 55" />
                                <path d="M192 39 209 58 184 61" />
                            </svg>
                            <svg class="za-flow za-flow-cargo-customer" viewBox="0 0 145 170" aria-hidden="true">
                                <path d="M38 10 C 96 42, 111 89, 104 145" />
                                <path d="M91 133 103 151 118 134" />
                            </svg>

                            <div class="za-art-card za-producer">
                                <img src="{{ asset('assets/zeytinci-abi/02_hero_uretici_fabrika.png') }}" alt="Zeytinyağı üreticisi">
                            </div>

                            <div class="za-art-card za-cargo">
                                <img src="{{ asset('assets/zeytinci-abi/04_hero_kargo_araci.png') }}" alt="Kargo aracı">
                                <span>Siparişi Biz Hazırlayalım<br>ve Kargolayalım</span>
                            </div>

                            <div class="za-art-card za-customer">
                                <img src="{{ asset('assets/zeytinci-abi/05_hero_musteri_kapida_teslim.png') }}" alt="Kapıda teslim alan müşteri">
                            </div>

                            <div class="za-art-card za-dealer">
                                <img src="{{ asset('assets/zeytinci-abi/03_hero_bayi_sen_bayi.png') }}" alt="Telefondan sipariş alan bayi">
                            </div>

                            <img class="za-bottles" src="{{ asset('assets/zeytinci-abi/06_zeytinyagi_urun_grubu.png') }}" alt="Zeytinci Abi zeytinyağı şişeleri">
                        </div>
                    </div>
                </section>

                <section id="nasil-calisir" class="za-how" aria-labelledby="how-title">
                    <div class="za-how-inner">
                        <h2 id="how-title">Sistem Nasıl İşliyor?</h2>

                        <div class="za-steps" aria-label="Sistem işleyiş adımları">
                            <article class="za-step-card">
                                <span class="za-step-no">1</span>
                                <span class="za-step-visual za-step-user" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <circle cx="32" cy="24" r="11" stroke="currentColor" stroke-width="4"/>
                                        <path d="M13 54c2.2-11.8 10.1-18 19-18s16.8 6.2 19 18" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <h3>Üye Ol</h3>
                                <p>Sisteme ücretsiz başvur.</p>
                            </article>

                            <span class="za-step-arrow" aria-hidden="true">→</span>

                            <article class="za-step-card">
                                <span class="za-step-no">2</span>
                                <span class="za-step-visual za-step-phone" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <rect x="21" y="6" width="22" height="52" rx="4" stroke="currentColor" stroke-width="3.5"/>
                                        <circle cx="32" cy="51" r="1.8" fill="currentColor"/>
                                    </svg>
                                    <i class="za-social za-instagram">◎</i>
                                    <i class="za-social za-facebook">f</i>
                                    <i class="za-social za-whatsapp">●</i>
                                </span>
                                <h3>Müşteri Bul</h3>
                                <p>Instagram, Facebook, WhatsApp veya çevrenden satış yap.</p>
                            </article>

                            <span class="za-step-arrow" aria-hidden="true">→</span>

                            <article class="za-step-card">
                                <span class="za-step-no">3</span>
                                <span class="za-step-visual za-step-box" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M12 21 32 10l20 11v22L32 55 12 43V21Z" stroke="currentColor" stroke-width="3.6" stroke-linejoin="round"/>
                                        <path d="m12 21 20 12 20-12M32 33v22M22 15l20 12" stroke="currentColor" stroke-width="3.6" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <h3>Siparişi Bize İlet</h3>
                                <p>Ürünü biz hazırlayalım, paketleyelim, kargolayalım.</p>
                            </article>

                            <span class="za-step-arrow" aria-hidden="true">→</span>

                            <article class="za-step-card">
                                <span class="za-step-no">4</span>
                                <span class="za-step-visual za-step-coins" aria-hidden="true">
                                    <img src="{{ asset('assets/zeytinci-abi/15_kazanc_ornegi_altin_para.png') }}" alt="">
                                </span>
                                <h3>Kârını Kazan</h3>
                                <p>Satıştan kazancını al.</p>
                            </article>
                        </div>

                        <div id="kazanc" class="za-profit-example" aria-label="Kazanç örneği">
                            <div class="za-profit-title">
                                <h3>Kazanç<br>Örneği</h3>
                                <span aria-hidden="true"></span>
                                <img src="{{ asset('assets/zeytinci-abi/14_kazanc_ornegi_zeytin_dali.png') }}" alt="">
                            </div>

                            <div class="za-profit-calc">
                                <div class="za-price-box">
                                    <strong>Normal Satış Fiyatı:</strong>
                                    <b>350 TL</b>
                                </div>
                                <span class="za-operator" aria-hidden="true">−</span>
                                <div class="za-price-box">
                                    <strong>Bayi Alış Fiyatı:</strong>
                                    <b>270 TL</b>
                                </div>
                                <span class="za-operator" aria-hidden="true">=</span>
                                <div class="za-price-box za-price-box-profit">
                                    <strong>Örnek Kazanç:</strong>
                                    <b>80 TL</b>
                                </div>
                            </div>

                            <img class="za-profit-coins" src="{{ asset('assets/zeytinci-abi/15_kazanc_ornegi_altin_para.png') }}" alt="">
                            <p>Fiyatlar örnektir. Ürün ve kampanyaya göre değişebilir.</p>
                        </div>
                    </div>
                </section>

                <section id="avantajlar" class="za-advantages" aria-labelledby="advantages-title">
                    <div class="za-advantages-inner">
                        <h2 id="advantages-title">Neden Zeytinci Abi?</h2>

                        <div class="za-advantage-grid">
                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M12 20 32 9l20 11v24L32 56 12 44V20Z" stroke="currentColor" stroke-width="3.4" stroke-linejoin="round"/>
                                        <path d="m12 20 20 12 20-12M32 32v24M22 14l20 12" stroke="currentColor" stroke-width="3.4" stroke-linejoin="round"/>
                                        <circle cx="46" cy="46" r="9" fill="#fffdf7" stroke="currentColor" stroke-width="3.2"/>
                                        <path d="m42.5 42.5 7 7M49.5 42.5l-7 7" stroke="currentColor" stroke-width="3.2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <h3>Stok Tutmazsın</h3>
                                <p>Stok derdi olmadan satış yaparsın.</p>
                            </article>

                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M9 28 32 12l23 16" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 26v30h34V26" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
                                        <path d="M24 56V39h16v17M24 32h16" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <h3>Depo Giderin Yok</h3>
                                <p>Depo kiralama ve masrafın olmaz.</p>
                            </article>

                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M9 19h28v25H9V19Z" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
                                        <path d="M37 28h9l8 9v7H37V28Z" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
                                        <circle cx="20" cy="47" r="5" stroke="currentColor" stroke-width="3.5"/>
                                        <circle cx="47" cy="47" r="5" stroke="currentColor" stroke-width="3.5"/>
                                    </svg>
                                </span>
                                <h3>Kargoyla Uğraşmazsın</h3>
                                <p>Kargolama sürecini biz yönetiriz.</p>
                            </article>

                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <circle cx="32" cy="32" r="23" stroke="currentColor" stroke-width="3.5"/>
                                        <path d="M42 22c-2.6-2.3-6-3.4-9.4-2.9-8.3 1.2-11.4 12-5.2 17.6 3.3 3 8 3.6 11.8 1.5M20 20l24 24" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M24 28h17M24 34h15" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <h3>Ön Ödeme Gerekmez</h3>
                                <p>Ürün için ödeme yapmana gerek yok.</p>
                            </article>

                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M32 8 52 16v15c0 12-7.5 20.6-20 26C19.5 51.6 12 43 12 31V16l20-8Z" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
                                        <path d="m23 32 7 7 13-15" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <h3>Ödeme Sistemini Biz Yönetiriz</h3>
                                <p>Güvenli ödeme altyapımız ile rahat edersin.</p>
                            </article>

                            <article class="za-advantage-card">
                                <span class="za-advantage-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <circle cx="32" cy="32" r="23" stroke="currentColor" stroke-width="3.5"/>
                                        <circle cx="32" cy="32" r="13" stroke="currentColor" stroke-width="3.5"/>
                                        <circle cx="32" cy="32" r="4" fill="currentColor"/>
                                        <path d="M32 9V4M55 32h5M32 55v5M9 32H4" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <h3>Sadece Satışa Odaklanırsın</h3>
                                <p>Zamanını ve enerjini satışa harcarsın.</p>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="za-audience" aria-labelledby="audience-title">
                    <div class="za-audience-inner">
                        <h2 id="audience-title">Kimler İçin Uygun?</h2>

                        <div class="za-audience-grid">
                            <article class="za-audience-card">
                                <img src="{{ asset('assets/zeytinci-abi/08_avatar_instagram_satis_yapanlar.png') }}" alt="Instagram üzerinden satış yapan kişi">
                                <h3>Instagram<br>Satış Yapanlar</h3>
                            </article>

                            <article class="za-audience-card">
                                <img src="{{ asset('assets/zeytinci-abi/09_avatar_facebook_tiktok_satici.png') }}" alt="Facebook ve TikTok üzerinden satış yapmak isteyen kişi">
                                <h3>Facebook / TikTok<br>Üzerinden Satmak İsteyenler</h3>
                            </article>

                            <article class="za-audience-card">
                                <img src="{{ asset('assets/zeytinci-abi/10_avatar_ek_gelir_arayanlar.png') }}" alt="Ek gelir arayan kişi">
                                <h3>Ek Gelir<br>Arayanlar</h3>
                            </article>

                            <article class="za-audience-card">
                                <img src="{{ asset('assets/zeytinci-abi/11_avatar_kendi_bayiligini_kurmak_isteyenler.png') }}" alt="Kendi bayiliğini kurmak isteyen kişi">
                                <h3>Kendi Bayiliğini<br>Kurmak İsteyenler</h3>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="za-winners" aria-labelledby="winners-title">
                    <div class="za-winners-inner">
                        <h2 id="winners-title">Bayi Daha Çok Kazanır</h2>

                        <div class="za-winner-grid">
                            <article class="za-winner-card">
                                <span class="za-winner-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <path d="M14 47V25h10v22M30 47V15h10v32M46 47V31h8v16" stroke="currentColor" stroke-width="3.4" stroke-linejoin="round"/>
                                        <path d="M9 47h50M15 21l8-8 7 7 9-11 12 10" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3>Müşteriyi Sen Bul</h3>
                                    <p>Satış fırsatını yakala, operasyon yükünü bize bırak.</p>
                                </div>
                            </article>

                            <article class="za-winner-card">
                                <span class="za-winner-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <circle cx="30" cy="23" r="11" fill="currentColor"/>
                                        <path d="M12 54c2.1-12.4 11-19 22-19s19.9 6.6 22 19" fill="currentColor"/>
                                        <rect x="38" y="36" width="18" height="18" rx="3" fill="#fffdf7" stroke="currentColor" stroke-width="3"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3>Stoksuz Satış Yap</h3>
                                    <p>Depo, paketleme ve kargo maliyetine girmeden sat.</p>
                                </div>
                            </article>

                            <article class="za-winner-card">
                                <span class="za-winner-icon" aria-hidden="true">
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <circle cx="21" cy="23" r="8" fill="currentColor"/>
                                        <circle cx="42" cy="23" r="8" fill="currentColor"/>
                                        <circle cx="32" cy="15" r="8" fill="currentColor"/>
                                        <path d="M9 52c1.6-8.8 7.4-14 16-14 2.7 0 5.1.5 7.1 1.5C34.1 38.5 36.7 38 40 38c8.6 0 14.4 5.2 16 14" fill="currentColor"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3>Kazancını Anlık Gör</h3>
                                    <p>Sipariş, kâr ve hak edişini panelden takip et.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section id="sss" class="za-faq" aria-labelledby="faq-title">
                    <div class="za-faq-inner">
                        <h2 id="faq-title">Sık Sorulan Sorular</h2>

                        <div class="za-faq-grid">
                            <article class="za-faq-card">
                                <div>
                                    <h3>Üye olmak ücretli mi?</h3>
                                    <p>Hayır, başvuru ücretsizdir.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>

                            <article class="za-faq-card">
                                <div>
                                    <h3>Ürünü ben mi kargoluyorum?</h3>
                                    <p>Hayır, siparişi biz hazırlayıp gönderiyoruz.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>

                            <article class="za-faq-card">
                                <div>
                                    <h3>Stok almak zorunda mıyım?</h3>
                                    <p>Hayır, stok tutmadan satış yapabilirsiniz.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>

                            <article class="za-faq-card">
                                <div>
                                    <h3>Satışa başlamak için sermaye gerekir mi?</h3>
                                    <p>Hayır, ürün satın almadan ve depo kurmadan müşteri bulup satışa başlayabilirsiniz.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>

                            <article class="za-faq-card">
                                <div>
                                    <h3>Müşteri sipariş verince ne oluyor?</h3>
                                    <p>Siparişi biz hazırlıyor, paketliyor ve kargoya veriyoruz; siz panelden süreci izliyorsunuz.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>

                            <article class="za-faq-card">
                                <div>
                                    <h3>Kazancımı nasıl takip ederim?</h3>
                                    <p>Her satıştan doğan kâr ve hak ediş panelinizde anlık görünür.</p>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="za-quality-profit" id="bayi-kazanc-modeli" aria-labelledby="quality-profit-title">
                    <div class="za-quality-profit-inner">
                        <div class="za-quality-left">
                            <div class="za-quality-brand">
                                <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png') }}" alt="Zeytinci Abi">
                                <span>Doğadan gelen kalite, size güven.</span>
                            </div>

                            <h2 id="quality-profit-title">Kaliteli Zeytinyağı,<br>Net Kâr,<br>Hızlı Ödeme</h2>
                            <p>Bayi stok tutmaz, kargo ve ödeme altyapısıyla uğraşmaz. Sen müşterini bulur, satışa odaklanırsın.</p>

                            <div class="za-quality-badges" aria-label="Zeytinyağı kalite avantajları">
                                <article class="za-quality-badge">
                                    <span class="za-quality-badge-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M25 7c2.8 6.2 9 11.1 9 19.2 0 6.3-4 10.8-10 10.8s-10-4.5-10-10.8C14 18.1 21.2 12.3 25 7Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
                                            <path d="M29.5 11.5 37 4.8M31.6 18.1l9.6-2.1M21 31c-2.3-2.4-2.8-5.4-1.5-8.8" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    <strong>0.3 / 0.5</strong>
                                    <span>Asit Oranı</span>
                                    <small>Natürel Sızma</small>
                                </article>

                                <article class="za-quality-badge">
                                    <span class="za-quality-badge-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M24 6 29.2 17l12 .9-9 7.8 2.8 11.7L24 31.2 13 37.4l2.8-11.7-9-7.8 12-.9L24 6Z" fill="currentColor"/>
                                            <path d="M10 34c-2 2.5-3.6 5.4-4.8 8.4M38 34c2 2.5 3.6 5.4 4.8 8.4" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    <strong>1. Kalite</strong>
                                    <span>Yüksek Kalite</span>
                                    <small>Zeytinyağı</small>
                                </article>

                                <article class="za-quality-badge">
                                    <span class="za-quality-badge-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M5 15h24v18H5V15Zm29 7h5.2l4.8 6.2V33H34V22Z" fill="currentColor"/>
                                            <circle cx="14" cy="35" r="4" fill="#fff" stroke="currentColor" stroke-width="3"/>
                                            <circle cx="37" cy="35" r="4" fill="#fff" stroke="currentColor" stroke-width="3"/>
                                        </svg>
                                    </span>
                                    <strong>Kargo Bizden</strong>
                                    <span>Depo ve</span>
                                    <small>Operasyon Yok</small>
                                </article>
                            </div>

                            <img class="za-quality-product" src="{{ asset('assets/zeytinci-abi/06_zeytinyagi_urun_grubu.png') }}" alt="Zeytinci Abi natürel sızma zeytinyağı">
                        </div>

                        <div class="za-quality-right">
                            <article class="za-profit-calculator" aria-label="Örnek kar hesabı">
                                <h3><span></span>Örnek Kâr Hesabı<span></span></h3>
                                <div class="za-profit-metrics">
                                    <div>
                                        <span>Bayi Alış Fiyatı</span>
                                        <strong>280 TL</strong>
                                    </div>
                                    <div>
                                        <span>Piyasa Satış Fiyatı</span>
                                        <strong>350 TL</strong>
                                    </div>
                                    <div class="za-profit-net">
                                        <span>Örnek Net Kâr</span>
                                        <strong>70 TL</strong>
                                    </div>
                                </div>
                                <p>
                                    <svg viewBox="0 0 32 32" fill="none" aria-hidden="true">
                                        <path d="M11 10h10l2 6.4c1.5 4.8-1.7 9.6-6.8 9.6h-.4c-5.1 0-8.3-4.8-6.8-9.6L11 10Z" stroke="currentColor" stroke-width="2.2"/>
                                        <path d="M12 10c-.8-2.7.8-5 4-5s4.8 2.3 4 5M16 14v8M13.4 16.4c.7-.9 1.8-1.4 3-1.3 1.8.1 3 1 3 2.4 0 1.4-1.2 2.1-3.4 2.1-2 0-3 .6-3 1.8 0 1.3 1.3 2.1 3 2.1 1.3 0 2.5-.5 3.2-1.4" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                                    </svg>
                                    Her satışta tahmini bayi kazancı
                                </p>
                            </article>

                            <div class="za-payment-flow" aria-label="Ödeme ve operasyon akışı">
                                <article class="za-flow-card">
                                    <span class="za-flow-number">1</span>
                                    <span class="za-flow-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M7 10h5l5 22h20l5-16H17" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="20" cy="38" r="3" fill="currentColor"/>
                                            <circle cx="34" cy="38" r="3" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <h4>Müşteri Sipariş Verir</h4>
                                        <p>Landing page üzerinden sipariş oluşturur.</p>
                                    </div>
                                </article>

                                <article class="za-flow-card">
                                    <span class="za-flow-number">2</span>
                                    <span class="za-flow-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <rect x="7" y="13" width="34" height="24" rx="4" fill="currentColor"/>
                                            <path d="M10 20h28M14 30h9" stroke="#fffdf7" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <h4>Kapıda Ödeme / Kart</h4>
                                        <p>Müşteri kapıda nakit veya kredi kartı ile ödeyebilir.</p>
                                    </div>
                                </article>

                                <article class="za-flow-card">
                                    <span class="za-flow-number">3</span>
                                    <span class="za-flow-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M24 5 42 14.5v19L24 43 6 33.5v-19L24 5Z" fill="currentColor"/>
                                            <path d="M7.5 15 24 24l16.5-9M24 24v18" stroke="#fffdf7" stroke-width="3" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <h4>Kargo Süreci Bizden</h4>
                                        <p>Paketleme ve gönderim merkez tarafından yapılır.</p>
                                    </div>
                                </article>

                                <article class="za-flow-card za-flow-card-highlight">
                                    <span class="za-flow-number">4</span>
                                    <span class="za-flow-icon" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" fill="none">
                                            <path d="M8 34h10l9-6.8c2.2-1.6 5.1-1.5 7 .3L21.5 39H8v-5Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
                                            <circle cx="31" cy="15" r="8" fill="currentColor"/>
                                            <path d="M31 10v10M27.5 13h7" stroke="#fffdf7" stroke-width="2.4" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <h4>1 Gün Sonra Bayiye Ödeme</h4>
                                        <p>Müşteri teslim aldıktan sonra kazanç bayiye aktarılır.</p>
                                    </div>
                                </article>
                            </div>
                        </div>

                        <div class="za-quality-strip" aria-label="Güven unsurları">
                            <span>
                                <svg viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M16 3 27 7v8c0 7-4.5 11.4-11 14C9.5 25.4 5 20 5 15V7l11-4Z" stroke="currentColor" stroke-width="2.4"/><path d="m10 16 4 4 8-9" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                %100 Güvenli Altyapı
                            </span>
                            <span>
                                <svg viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M16 3 27 7v8c0 7-4.5 11.4-11 14C9.5 25.4 5 20 5 15V7l11-4Z" stroke="currentColor" stroke-width="2.4"/><path d="m10 16 4 4 8-9" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Vergi ve Resmi Faturalı
                            </span>
                            <span>
                                <svg viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M7 22c9 0 15-5 18-15-9 0-15 5-18 15Z" fill="currentColor"/><path d="M7 22c4-4 8-6 13-8M14 22c0 3-2 5-5 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                Erken Hasat, Soğuk Sıkım
                            </span>
                            <span>
                                <svg viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M8 18v-4a8 8 0 0 1 16 0v4M8 18H6v5h4v-5H8Zm16 0h2v5h-4v-5h2Zm0 5c0 3-2.5 5-7 5" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                7/24 Destek
                            </span>
                        </div>
                    </div>
                </section>

                <section id="bayi-ol" class="za-final-cta" aria-labelledby="final-cta-title">
                    <div class="za-final-cta-inner">
                        <img class="za-final-branch" src="{{ asset('assets/zeytinci-abi/13_footer_cta_sol_zeytin_dali.png') }}" alt="">
                        <div class="za-final-copy">
                            <h2 id="final-cta-title">Sen de Zeytinci Abi Bayisi Ol</h2>
                            <p>Stok derdi olmadan, zeytinyağı satışına başla.</p>
                            <a href="{{ route('register') }}" class="za-final-button">
                                <span class="za-icon-badge" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M12 12.4a4.1 4.1 0 1 0 0-8.2 4.1 4.1 0 0 0 0 8.2Z" fill="currentColor"/>
                                        <path d="M4.7 20.1c.7-3.5 3.2-5.5 7.3-5.5s6.6 2 7.3 5.5c.1.5-.3.9-.8.9h-17c-.5 0-.9-.4-.8-.9Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                Hemen Başvur
                            </a>
                            <small>Başvuru sonrası sizinle iletişime geçelim.</small>
                        </div>
                        <img class="za-final-bottle" src="{{ asset('assets/zeytinci-abi/12_footer_cta_sag_zeytinyagi_sisesi.png') }}" alt="Zeytinci Abi zeytinyağı şişesi">
                    </div>
                </section>
            </main>

            <footer class="za-footer">
                <div class="za-footer-inner">
                    <div class="za-footer-brand">
                        <img src="{{ asset('assets/zeytinci-abi/logo-zeytinci-abi-site.png') }}" alt="Zeytinci Abi">
                        <p>Zeytinyağı üreticileri ile bayileri buluşturan güvenilir satış platformu.</p>
                    </div>

                    <nav class="za-footer-links" aria-label="Alt menü">
                        <a href="#nasil-calisir">Nasıl Çalışır?</a>
                        <a href="#kazanc">Kazanç</a>
                        <a href="#avantajlar">Avantajlar</a>
                    </nav>

                    <nav class="za-footer-links" aria-label="Yardım menüsü">
                        <a href="#sss">SSS</a>
                        <a href="{{ route('register') }}">Bayi Ol</a>
                        <a href="#bayi-ol">İletişim</a>
                    </nav>

                    <div class="za-footer-contact">
                        <p><span>☎</span> 0850 123 45 67</p>
                        <p><span>✉</span> info@zeytinciabi.com</p>
                        <div class="za-social-row" aria-label="Sosyal medya">
                            <span>f</span>
                            <span>▶</span>
                            <span>◎</span>
                            <span>♪</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
