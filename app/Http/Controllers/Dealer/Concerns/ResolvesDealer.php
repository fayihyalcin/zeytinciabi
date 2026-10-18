<?php

namespace App\Http\Controllers\Dealer\Concerns;

use App\Models\DealerProfile;
use Illuminate\Http\Request;

trait ResolvesDealer
{
    protected function currentDealer(Request $request): DealerProfile
    {
        return $request->user()
            ->dealerProfile()
            ->firstOrFail();
    }
}
