<?php

namespace App\Policies;

use App\Models\DealerProfile;
use App\Models\User;

class DealerProfilePolicy
{
    public function view(User $user, DealerProfile $dealerProfile): bool
    {
        return $this->ownsProfile($user, $dealerProfile);
    }

    public function update(User $user, DealerProfile $dealerProfile): bool
    {
        return $this->ownsProfile($user, $dealerProfile);
    }

    private function ownsProfile(User $user, DealerProfile $dealerProfile): bool
    {
        return $user->isDealer() && $dealerProfile->user_id === $user->id;
    }
}
