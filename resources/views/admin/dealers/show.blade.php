@extends('layouts.admin')

@section('title', 'Bayi Detay')
@section('page_title', $dealer->display_name)
@section('page_subtitle', $dealer->dealer_code.' - '.$dealer->dealer_slug)

@section('content')
    <div class="grid gap-4 xl:grid-cols-3">
        <section class="rounded-lg border border-[#e3d8c5] bg-white p-5 xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-bold">Bayi Bilgileri</h2>
                <x-status-badge :value="$dealer->status" />
            </div>
            <dl class="grid gap-3 text-sm md:grid-cols-2">
                <div><dt class="text-[#6b6d65]">Kullanıcı</dt><dd class="font-semibold">{{ $dealer->user?->name }}</dd></div>
                <div><dt class="text-[#6b6d65]">İletişim</dt><dd class="font-semibold">{{ $dealer->user?->email ?? '-' }} / {{ $dealer->whatsapp_phone ?? $dealer->user?->phone ?? '-' }}</dd></div>
                <div><dt class="text-[#6b6d65]">Firma</dt><dd class="font-semibold">{{ $dealer->company_name ?? '-' }}</dd></div>
                <div><dt class="text-[#6b6d65]">Vergi / Kimlik</dt><dd class="font-semibold">{{ $dealer->tax_number ?? $dealer->identity_number ?? '-' }}</dd></div>
                <div><dt class="text-[#6b6d65]">Şehir</dt><dd class="font-semibold">{{ $dealer->city ?? '-' }} / {{ $dealer->district ?? '-' }}</dd></div>
                <div><dt class="text-[#6b6d65]">IBAN</dt><dd class="font-semibold">{{ $dealer->iban ?? '-' }}</dd></div>
                <div class="md:col-span-2"><dt class="text-[#6b6d65]">Adres</dt><dd class="font-semibold">{{ $dealer->address ?? '-' }}</dd></div>
            </dl>
        </section>
        <section class="rounded-lg border border-[#e3d8c5] bg-white p-5">
            <h2 class="mb-4 text-lg font-bold">Operasyon</h2>
            <div class="grid gap-2 text-sm">
                <div class="flex justify-between"><span>Ürün</span><strong>{{ $dealer->dealer_products_count }}</strong></div>
                <div class="flex justify-between"><span>Landing</span><strong>{{ $dealer->landing_pages_count }}</strong></div>
                <div class="flex justify-between"><span>Sipariş</span><strong>{{ $dealer->orders_count }}</strong></div>
                <div class="flex justify-between"><span>Hak Ediş</span><strong>{{ $dealer->earnings_count }}</strong></div>
            </div>
            @if ($dealer->status !== \App\Enums\DealerStatus::Approved)
                <form method="POST" action="{{ route('admin.dealers.approve', $dealer) }}" class="mt-5">
                    @csrf
                    <button class="w-full rounded-lg bg-[#35580b] px-4 py-2 text-sm font-bold text-white">Onayla</button>
                </form>
            @endif
            @if ($dealer->status !== \App\Enums\DealerStatus::Rejected)
                <form method="POST" action="{{ route('admin.dealers.reject', $dealer) }}" class="mt-3 grid gap-2">
                    @csrf
                    <textarea name="rejected_reason" rows="3" class="rounded-lg border-[#d8cdb9]" placeholder="Red nedeni"></textarea>
                    <button class="rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-bold text-red-700">Reddet</button>
                </form>
            @endif
        </section>
    </div>
@endsection
