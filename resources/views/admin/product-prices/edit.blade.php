@extends('layouts.admin')

@section('title', 'Fiyat Düzenle')
@section('page_title', 'Fiyat Düzenle')
@section('page_subtitle', $price->product?->name ?? 'Ürün fiyatı')

@section('content')
    <form method="POST" action="{{ route('admin.product-prices.update', $price) }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @method('PUT')
        @include('admin.product-prices._form')
    </form>
@endsection
