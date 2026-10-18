@extends('layouts.admin')

@section('title', 'Yeni Kategori')
@section('page_title', 'Yeni Kategori')
@section('page_subtitle', 'Ürün katalog grubu oluştur')

@section('content')
    <form method="POST" action="{{ route('admin.product-categories.store') }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @include('admin.product-categories._form')
    </form>
@endsection
