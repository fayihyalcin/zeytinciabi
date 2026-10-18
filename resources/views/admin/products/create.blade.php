@extends('layouts.admin')

@section('title', 'Yeni Ürün')
@section('page_title', 'Yeni Ürün')
@section('page_subtitle', 'Katalog ürünü oluştur')

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @include('admin.products._form')
    </form>
@endsection
