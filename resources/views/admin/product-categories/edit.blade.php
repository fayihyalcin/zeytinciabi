@extends('layouts.admin')

@section('title', 'Kategori Düzenle')
@section('page_title', 'Kategori Düzenle')
@section('page_subtitle', $category->name)

@section('content')
    <form method="POST" action="{{ route('admin.product-categories.update', $category) }}" class="rounded-lg border border-[#e3d8c5] bg-white p-5">
        @method('PUT')
        @include('admin.product-categories._form')
    </form>
@endsection
