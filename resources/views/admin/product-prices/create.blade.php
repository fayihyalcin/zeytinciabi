@extends('layouts.admin')

@section('title', 'Yeni Fiyat')
@section('page_title', 'Yeni Fiyat')
@section('page_subtitle', 'Ürün fiyat kuralı oluştur')

@section('content')
    <form method="POST" action="{{ route('admin.product-prices.store') }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @include('admin.product-prices._form')
    </form>
@endsection
