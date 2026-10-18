<?php

namespace App\Policies;

use App\Models\DealerEarning;
use App\Models\User;

class DealerEarningPolicy
{
    public function view(User $user, DealerEarning $dealerEarning): bool
    {
        return $user->isDealer()
            && $user->dealerProfile()
                ->whereKey($dealerEarning->dealer_id)
                ->exists();
    }

    public function update(User $user, DealerEarning $dealerEarning): bool
    {
        return false;
    }
}
