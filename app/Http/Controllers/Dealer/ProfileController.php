<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Http\Requests\Dealer\UpdateDealerProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use ResolvesDealer;

    public function edit(Request $request): View
    {
        $dealer = $this->currentDealer($request);
        Gate::authorize('update', $dealer);

        return view('dealer.profile.edit', compact('dealer'));
    }

    public function update(UpdateDealerProfileRequest $request): RedirectResponse
    {
        $dealer = $this->currentDealer($request);
        Gate::authorize('update', $dealer);

        DB::transaction(fn () => $dealer->update($request->validated()));

        return back()->with('status', 'Bayi profil bilgileri güncellendi.');
    }
}
