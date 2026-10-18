@extends('layouts.dealer')

@section('title', 'Landing Page Düzenle')

@section('content')
<section class="welcome">
    <div>
        <h1>{{ $landingPage->title }} <span class="leaf-mark">•</span></h1>
        <p>Sayfa metinlerini, ürünleri ve satış fiyatlarını düzenle.</p>
    </div>
    <a href="{{ route('public.landing.show', $landingPage) }}" target="_blank" class="create-btn">Önizle</a>
</section>

@include('dealer.landing-pages._form', [
    'action' => route('dealer.landing-pages.update', $landingPage),
    'method' => 'PATCH',
])
@endsection
