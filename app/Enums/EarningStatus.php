<?php

namespace App\Enums;

enum EarningStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Payable = 'payable';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
}
