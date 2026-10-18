@extends('layouts.dealer')

@section('title', 'Hak Edişlerim')

@section('content')
<section class="welcome">
    <div>
        <h1>Hak Edişlerim <span class="leaf-mark">•</span></h1>
        <p>Ödeme paketleri, banka bilgileri ve ödeme durumları.</p>
    </div>
</section>

<section class="summary-row">
    <article class="stat card"><div class="stat-ico">₺</div><div><h3>Bekleyen Ödeme</h3><strong>{{ number_format((float) $totals['pending'], 2, ',', '.') }} TL</strong></div></article>
    <article class="stat card gold"><div class="stat-ico">✓</div><div><h3>Ödenen</h3><strong>{{ number_format((float) $totals['paid'], 2, ',', '.') }} TL</strong></div></article>
</section>

<section class="grid gap-4 mt-5">
    @forelse($payouts as $payout)
        <article class="card p-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-serif text-2xl font-bold">{{ $payout->payout_number }}</h2>
                    <p class="text-sm text-[#6b6d65]">{{ $payout->bank_name ?? 'Banka yok' }} · {{ $payout->iban ?? 'IBAN yok' }}</p>
                </div>
                <div class="text-right">
                    <strong class="block text-2xl">{{ number_format((float) $payout->total_amount, 2, ',', '.') }} TL</strong>
                    <x-status-badge :value="$payout->status" />
                </div>
            </div>
        </article>
    @empty
        <article class="card p-8 text-center text-[#6b6d65]">Henüz hak ediş ödeme kaydı yok.</article>
    @endforelse
</section>

<div class="mt-5">{{ $payouts->links() }}</div>
@endsection
