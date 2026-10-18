@extends('layouts.admin')

@section('title', 'Ödemeler')
@section('page_title', 'Bayi Ödemeleri')
@section('page_subtitle', 'Hak ediş ödeme paketleri')

@section('content')
    <div class="overflow-hidden rounded-lg border border-[#e3d8c5] bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#f6f1e8] text-xs uppercase text-[#6b6d65]">
                <tr><th class="p-3">No</th><th class="p-3">Bayi</th><th class="p-3">Tutar</th><th class="p-3">Durum</th><th class="p-3">Ödendi</th></tr>
            </thead>
            <tbody>
                @forelse ($payouts as $payout)
                    <tr class="border-t border-[#eee4d7]">
                        <td class="p-3 font-semibold">{{ $payout->payout_number }}</td>
                        <td class="p-3">{{ $payout->dealer?->display_name }}</td>
                        <td class="p-3">{{ number_format((float) $payout->total_amount, 2, ',', '.') }} TL</td>
                        <td class="p-3"><x-status-badge :value="$payout->status" /></td>
                        <td class="p-3">{{ optional($payout->paid_at)->format('d.m.Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-[#6b6d65]">Henüz ödeme yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $payouts->links() }}</div>
@endsection
