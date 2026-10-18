@extends('layouts.dealer')

@section('title', 'Landing Page Oluştur')

@section('content')
<section class="welcome">
    <div>
        <h1>Yeni Landing Page <span class="leaf-mark">•</span></h1>
        <p>Ürünlerini seç, satış fiyatlarını belirle ve sayfayı yayına hazırla.</p>
    </div>
</section>

@include('dealer.landing-pages._form', [
    'action' => route('dealer.landing-pages.store'),
    'method' => 'POST',
])
@endsection
