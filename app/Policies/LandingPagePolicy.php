<?php

namespace App\Policies;

use App\Models\LandingPage;
use App\Models\User;

class LandingPagePolicy
{
    public function view(User $user, LandingPage $landingPage): bool
    {
        return $this->ownsLandingPage($user, $landingPage);
    }

    public function update(User $user, LandingPage $landingPage): bool
    {
        return $this->ownsLandingPage($user, $landingPage);
    }

    public function delete(User $user, LandingPage $landingPage): bool
    {
        return $this->ownsLandingPage($user, $landingPage);
    }

    private function ownsLandingPage(User $user, LandingPage $landingPage): bool
    {
        return $user->isDealer()
            && $user->dealerProfile()
                ->whereKey($landingPage->dealer_id)
                ->exists();
    }
}
