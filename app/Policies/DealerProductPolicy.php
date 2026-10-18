<?php

namespace App\Policies;

use App\Models\DealerProduct;
use App\Models\User;

class DealerProductPolicy
{
    public function view(User $user, DealerProduct $dealerProduct): bool
    {
        return $this->ownsDealerRecord($user, $dealerProduct->dealer_id);
    }

    public function update(User $user, DealerProduct $dealerProduct): bool
    {
        return $this->ownsDealerRecord($user, $dealerProduct->dealer_id);
    }

    private function ownsDealerRecord(User $user, int $dealerId): bool
    {
        return $user->isDealer()
            && $user->dealerProfile()
                ->whereKey($dealerId)
                ->exists();
    }
}
