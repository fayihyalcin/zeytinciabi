@extends('layouts.public')

@section('title', $landingPage->title.' | Zeytinci Abi')

@section('content')
    <section class="mx-auto grid min-h-screen max-w-7xl gap-8 px-4 py-8 lg:grid-cols-[1fr_420px] lg:px-8">
        <div>
            <div class="rounded-lg border border-[#e3d8c5] bg-white p-6 shadow-sm">
                <p class="text-sm font-bold uppercase tracking-wide text-[#52741e]">{{ $landingPage->dealer->display_name }}</p>
                <h1 class="mt-3 font-serif text-4xl font-bold leading-tight md:text-6xl">{{ $landingPage->headline ?: $landingPage->title }}</h1>
                @if ($landingPage->subheadline || $landingPage->description)
                    <p class="mt-4 max-w-3xl text-lg text-[#5f635d]">{{ $landingPage->subheadline ?: $landingPage->description }}</p>
                @endif
                @if (session('status'))
                    <div class="mt-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-2">
                @foreach ($landingPage->landingPageProducts->where('is_active', true) as $landingProduct)
                    <article class="rounded-lg border border-[#e3d8c5] bg-white p-5 shadow-sm">
                        @if ($landingProduct->product->main_image)
                            <img src="{{ asset($landingProduct->product->main_image) }}" alt="{{ $landingProduct->product->name }}" class="mb-4 aspect-[4/3] w-full rounded-lg object-cover">
                        @endif
                        <h2 class="font-serif text-2xl font-bold">{{ $landingProduct->product->name }}</h2>
                        <p class="mt-2 text-sm text-[#6b6d65]">{{ $landingProduct->product->short_description }}</p>
                        <p class="mt-4 font-serif text-3xl font-bold">{{ number_format((float) $landingProduct->sale_price, 2, ',', '.') }} TL</p>
                    </article>
                @endforeach
            </div>
        </div>

        <aside class="lg:sticky lg:top-6 lg:self-start">
            <form method="POST" action="{{ route('public.landing.orders.store', $landingPage) }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5 shadow-sm">
                @csrf
                <h2 class="font-serif text-2xl font-bold">Sipariş Ver</h2>
                <div class="mt-4 grid gap-3">
                    @foreach ($landingPage->landingPageProducts->where('is_active', true) as $landingProduct)
                        <label class="grid grid-cols-[1fr_82px] items-center gap-3 rounded-lg border border-[#eee4d7] bg-[#fbf8f2] p-3 text-sm font-semibold">
                            <span>{{ $landingProduct->product->name }}</span>
                            <input type="hidden" name="items[{{ $loop->index }}][landing_page_product_id]" value="{{ $landingProduct->id }}">
                            <input type="number" name="items[{{ $loop->index }}][quantity]" value="{{ $loop->first ? 1 : 0 }}" min="0" max="99" class="rounded-lg border-[#d8cdb9]">
                        </label>
                    @endforeach
                </div>

                <div class="mt-5 grid gap-3">
                    <input name="customer_name" value="{{ old('customer_name') }}" placeholder="Ad Soyad" class="rounded-lg border-[#d8cdb9]" required>
                    <input name="customer_phone" value="{{ old('customer_phone') }}" placeholder="Telefon" class="rounded-lg border-[#d8cdb9]" required>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <input name="customer_city" value="{{ old('customer_city') }}" placeholder="İl" class="rounded-lg border-[#d8cdb9]" required>
                        <input name="customer_district" value="{{ old('customer_district') }}" placeholder="İlçe" class="rounded-lg border-[#d8cdb9]" required>
                    </div>
                    <textarea name="customer_address" rows="3" placeholder="Açık adres" class="rounded-lg border-[#d8cdb9]" required>{{ old('customer_address') }}</textarea>
                    <textarea name="customer_note" rows="2" placeholder="Not" class="rounded-lg border-[#d8cdb9]">{{ old('customer_note') }}</textarea>
                    @if ($errors->any())
                        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <button class="rounded-lg bg-[#52741e] px-5 py-3 text-sm font-bold text-white">Siparişi Gönder</button>
                </div>
            </form>
        </aside>
    </section>
@endsection
