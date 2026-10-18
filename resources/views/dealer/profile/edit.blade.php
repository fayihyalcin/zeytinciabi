@extends('layouts.dealer')

@section('title', 'Profilim')

@section('content')
<section class="welcome">
    <div>
        <h1>Profilim <span class="leaf-mark">•</span></h1>
        <p>Bayi firma, iletişim ve ödeme bilgilerini güncel tut.</p>
    </div>
</section>

@if ($errors->any())
    <div class="session-status">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('dealer.profile.update') }}" class="card grid gap-4 p-5">
    @csrf
    @method('PATCH')
    <div class="grid gap-4 lg:grid-cols-2">
        <label class="grid gap-1 text-sm font-semibold">Görünen bayi adı
            <input name="display_name" value="{{ old('display_name', $dealer->display_name) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">Firma adı
            <input name="company_name" value="{{ old('company_name', $dealer->company_name) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">TC / Kimlik No
            <input name="identity_number" value="{{ old('identity_number', $dealer->identity_number) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">Vergi No
            <input name="tax_number" value="{{ old('tax_number', $dealer->tax_number) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">Banka
            <input name="bank_name" value="{{ old('bank_name', $dealer->bank_name) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">IBAN
            <input name="iban" value="{{ old('iban', $dealer->iban) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">İl
            <input name="city" value="{{ old('city', $dealer->city) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">İlçe
            <input name="district" value="{{ old('district', $dealer->district) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold lg:col-span-2">Adres
            <textarea name="address" rows="3" class="rounded-xl border border-[#d8cdb9] px-3 py-2">{{ old('address', $dealer->address) }}</textarea>
        </label>
        <label class="grid gap-1 text-sm font-semibold">WhatsApp
            <input name="whatsapp_phone" value="{{ old('whatsapp_phone', $dealer->whatsapp_phone) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">Instagram URL
            <input name="instagram_url" value="{{ old('instagram_url', $dealer->instagram_url) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">Facebook URL
            <input name="facebook_url" value="{{ old('facebook_url', $dealer->facebook_url) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
        <label class="grid gap-1 text-sm font-semibold">TikTok URL
            <input name="tiktok_url" value="{{ old('tiktok_url', $dealer->tiktok_url) }}" class="rounded-xl border border-[#d8cdb9] px-3 py-2">
        </label>
    </div>
    <button class="create-btn w-fit" type="submit">Profili Güncelle</button>
</form>
@endsection
