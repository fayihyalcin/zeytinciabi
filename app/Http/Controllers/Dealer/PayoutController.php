<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\PayoutStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Models\DealerPayout;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayoutController extends Controller
{
    use ResolvesDealer;

    public function index(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $payoutsQuery = DealerPayout::query()->forDealer($dealer->id);

        $totals = [
            'pending' => (clone $payoutsQuery)->whereIn('status', [PayoutStatus::Pending->value, PayoutStatus::Processing->value])->sum('total_amount'),
            'paid' => (clone $payoutsQuery)->where('status', PayoutStatus::Paid->value)->sum('total_amount'),
        ];

        $payouts = $payoutsQuery
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('dealer.payouts.index', [
            'payouts' => $payouts,
            'totals' => $totals,
            'statuses' => PayoutStatus::cases(),
            'activeStatus' => $request->string('status')->toString(),
        ]);
    }
}
