<?php

namespace App\Policies;

use App\Models\DealerPayout;
use App\Models\User;

class DealerPayoutPolicy
{
    public function view(User $user, DealerPayout $dealerPayout): bool
    {
        return $user->isDealer()
            && $user->dealerProfile()
                ->whereKey($dealerPayout->dealer_id)
                ->exists();
    }

    public function update(User $user, DealerPayout $dealerPayout): bool
    {
        return false;
    }
}
