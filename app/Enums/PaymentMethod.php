<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CashOnDelivery = 'cod';
    case CardOnDelivery = 'card_on_delivery';
    case OnlineCard = 'online_card';
    case BankTransfer = 'bank_transfer';
}
