@extends('layouts.admin')

@section('title', 'Ürün Düzenle')
@section('page_title', 'Ürün Düzenle')
@section('page_subtitle', $product->name)

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @method('PUT')
        @include('admin.products._form')
    </form>
@endsection
