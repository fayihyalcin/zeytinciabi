@extends('layouts.dealer')

@section('title', 'Kazançlarım')

@section('content')
<section class="welcome">
    <div>
        <h1>Kazançlarım <span class="leaf-mark">•</span></h1>
        <p>Sipariş bazlı kar ve ödeme durumlarını takip et.</p>
    </div>
</section>

<section class="summary-row">
    <article class="stat card"><div class="stat-ico">₺</div><div><h3>Bekleyen</h3><strong>{{ number_format((float) $totals['pending'], 2, ',', '.') }} TL</strong></div></article>
    <article class="stat card gold"><div class="stat-ico">✓</div><div><h3>Ödenen</h3><strong>{{ number_format((float) $totals['paid'], 2, ',', '.') }} TL</strong></div></article>
    <article class="stat card"><div class="stat-ico">!</div><div><h3>İptal</h3><strong>{{ number_format((float) $totals['cancelled'], 2, ',', '.') }} TL</strong></div></article>
</section>

<section class="card mt-5 p-5">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left text-sm">
            <thead class="text-[#6b6d65]"><tr><th class="py-3">Sipariş</th><th>Tutar</th><th>Durum</th><th>Ödenebilir</th><th>Referans</th></tr></thead>
            <tbody>
                @forelse($earnings as $earning)
                    <tr>
                        <td class="border-t border-[#f0e8d9] py-3 font-bold">{{ $earning->order?->order_number ?? '-' }}</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ number_format((float) $earning->amount, 2, ',', '.') }} TL</td>
                        <td class="border-t border-[#f0e8d9] py-3"><x-status-badge :value="$earning->status" /></td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ $earning->payable_at?->format('d.m.Y') ?? '-' }}</td>
                        <td class="border-t border-[#f0e8d9] py-3">{{ $earning->payment_reference ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-8 text-center text-[#6b6d65]">Henüz kazanç kaydı yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div class="mt-5">{{ $earnings->links() }}</div>
@endsection
