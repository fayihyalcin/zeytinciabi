<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->isDealer()
            && $user->dealerProfile()
                ->whereKey($order->dealer_id)
                ->exists();
    }

    public function update(User $user, Order $order): bool
    {
        return false;
    }
}
