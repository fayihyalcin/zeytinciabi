@extends('layouts.admin')

@section('title', 'Hak Edişler')
@section('page_title', 'Hak Edişler')
@section('page_subtitle', 'Sipariş bazlı bayi kazançları')

@section('content')
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">Bayi</th><th class="p-3">Sipariş</th><th class="p-3">Tutar</th><th class="p-3">Durum</th><th class="p-3">Ödenebilir</th></tr>
            </thead>
            <tbody>
                @forelse ($earnings as $earning)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $earning->dealer?->display_name }}</td>
                        <td class="p-3">{{ $earning->order?->order_number }}</td>
                        <td class="p-3">{{ number_format((float) $earning->amount, 2, ',', '.') }} TL</td>
                        <td class="p-3"><x-status-badge :value="$earning->status" /></td>
                        <td class="p-3">{{ optional($earning->payable_at)->format('d.m.Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-[#6b6d65]">Henüz hak ediş yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $earnings->links() }}</div>
@endsection
