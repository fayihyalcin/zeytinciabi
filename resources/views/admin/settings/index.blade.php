@extends('layouts.admin')

@section('title', 'Ayarlar')
@section('page_title', 'Ayarlar')
@section('page_subtitle', 'Sistem anahtarları ve yapılandırma')

@section('content')
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Grup</th><th class="p-3">Anahtar</th><th class="p-3">Tip</th><th class="p-3">Değer</th></tr>
            </thead>
            <tbody>
                @forelse ($settings as $setting)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3">{{ $setting->group ?? '-' }}</td>
                        <td class="p-3 font-semibold">{{ $setting->key }}</td>
                        <td class="p-3">{{ $setting->type ?? '-' }}</td>
                        <td class="p-3">{{ str($setting->value)->limit(80) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-6 text-center text-[#6b6d65]">Henüz ayar yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $settings->links() }}</div>
@endsection
