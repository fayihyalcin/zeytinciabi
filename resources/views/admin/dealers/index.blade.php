@extends('layouts.admin')

@section('title', 'Bayiler')
@section('page_title', isset($onlyPending) ? 'Bekleyen Başvurular' : 'Bayiler')
@section('page_subtitle', 'Bayi hesapları ve onay durumları')

@section('content')
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Bayi</th><th class="p-3">Kullanıcı</th><th class="p-3">Konum</th><th class="p-3">Durum</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($dealers as $dealer)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $dealer->display_name }}<div class="text-xs text-[#6b6d65]">{{ $dealer->dealer_code }}</div></td>
                        <td class="p-3">{{ $dealer->user?->name }}<div class="text-xs text-[#6b6d65]">{{ $dealer->user?->email ?? $dealer->user?->phone }}</div></td>
                        <td class="p-3">{{ trim(($dealer->city ?? '').' / '.($dealer->district ?? ''), ' /') ?: '-' }}</td>
                        <td class="p-3"><x-status-badge :value="$dealer->status" /></td>
                        <td class="p-3 text-right"><a class="font-bold text-[#35580b]" href="{{ route('admin.dealers.show', $dealer) }}">Detay</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-[#6b6d65]">Kayıt bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $dealers->links() }}</div>
@endsection
