@extends('layouts.dealer')

@section('title', 'Landing Page')
@section('page_subtitle', 'Satış sayfalarını yönet')

@section('content')
<section class="welcome">
    <div>
        <h1>Landing Page'lerim <span class="leaf-mark">•</span></h1>
        <p>Müşteri bulmak için kullandığın satış sayfalarını buradan yönet.</p>
    </div>
    <a href="{{ route('dealer.landing-pages.create') }}" class="create-btn"><span class="plus">+</span> Yeni Landing Page</a>
</section>

<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @forelse ($landingPages as $landingPage)
        <article class="card p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold">{{ $landingPage->title }}</h2>
                    <p class="mt-1 text-sm text-[#6b6d65]">/lp/{{ $landingPage->slug }}</p>
                </div>
                <x-status-badge :value="$landingPage->is_active ? 'active' : 'passive'" />
            </div>
            <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                <div class="rounded-2xl border border-[#e6dccb] bg-[#fbf8f2] p-3">
                    <span class="text-[#6b6d65]">Sipariş</span>
                    <strong class="block text-xl">{{ $landingPage->orders_count }}</strong>
                </div>
                <div class="rounded-2xl border border-[#e6dccb] bg-[#fbf8f2] p-3">
                    <span class="text-[#6b6d65]">Yayın</span>
                    <strong class="block text-sm">{{ $landingPage->published_at?->format('d.m.Y') ?? 'Hazır değil' }}</strong>
                </div>
            </div>
            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('dealer.landing-pages.edit', $landingPage) }}" class="rounded-xl border border-[#d8cdb9] px-4 py-2 text-sm font-bold text-[#52741e]">Düzenle</a>
                <a href="{{ route('public.landing.show', $landingPage) }}" target="_blank" class="rounded-xl border border-[#d8cdb9] px-4 py-2 text-sm font-bold text-[#3f463b]">Önizle</a>
            </div>
        </article>
    @empty
        <article class="card p-8 text-center text-[#6b6d65] md:col-span-2 xl:col-span-3">Henüz landing page yok. İlk sayfanı oluşturup satışa başlayabilirsin.</article>
    @endforelse
</section>

<div class="mt-5">{{ $landingPages->links() }}</div>
@endsection
