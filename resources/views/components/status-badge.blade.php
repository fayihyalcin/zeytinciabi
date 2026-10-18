@props(['value'])

@php
    $raw = $value instanceof \BackedEnum ? $value->value : (string) $value;
    $labels = [
        'active' => 'Aktif',
        'passive' => 'Pasif',
        'suspended' => 'Askıda',
        'pending' => 'Bekliyor',
        'approved' => 'Onaylı',
        'rejected' => 'Reddedildi',
        'in_stock' => 'Stokta',
        'out_of_stock' => 'Stok Yok',
        'preorder' => 'Ön Sipariş',
        'confirmed' => 'Onaylandı',
        'preparing' => 'Hazırlanıyor',
        'shipped' => 'Kargoda',
        'delivered' => 'Teslim',
        'cancelled' => 'İptal',
        'returned' => 'İade',
        'failed' => 'Başarısız',
        'paid' => 'Ödendi',
        'payable' => 'Ödenebilir',
        'processing' => 'İşleniyor',
        'cod_pending' => 'Kapıda Bekliyor',
        'cod_collected' => 'Kapıda Alındı',
    ];
    $tone = in_array($raw, ['active', 'approved', 'in_stock', 'delivered', 'paid', 'cod_collected'], true)
        ? 'border-green-200 bg-green-50 text-green-700'
        : (in_array($raw, ['pending', 'preparing', 'processing', 'payable', 'cod_pending'], true)
            ? 'border-amber-200 bg-amber-50 text-amber-700'
            : 'border-red-200 bg-red-50 text-red-700');
@endphp

<span {{ $attributes->merge(['class' => "inline-flex rounded-full border px-2.5 py-1 text-xs font-semibold {$tone}"]) }}>
    {{ $labels[$raw] ?? $raw }}
</span>
