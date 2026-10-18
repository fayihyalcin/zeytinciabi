<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case CodPending = 'cod_pending';
    case CodCollected = 'cod_collected';
    case Failed = 'failed';
    case Refunded = 'refunded';
}
