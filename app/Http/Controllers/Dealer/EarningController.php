<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\EarningStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Models\DealerEarning;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EarningController extends Controller
{
    use ResolvesDealer;

    public function index(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $earningsQuery = DealerEarning::query()->forDealer($dealer->id);

        $totals = [
            'pending' => (clone $earningsQuery)->whereIn('status', [EarningStatus::Pending->value, EarningStatus::Approved->value, EarningStatus::Payable->value])->sum('amount'),
            'paid' => (clone $earningsQuery)->where('status', EarningStatus::Paid->value)->sum('amount'),
            'cancelled' => (clone $earningsQuery)->where('status', EarningStatus::Cancelled->value)->sum('amount'),
        ];

        $earnings = $earningsQuery
            ->with('order')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('dealer.earnings.index', [
            'earnings' => $earnings,
            'totals' => $totals,
            'statuses' => EarningStatus::cases(),
            'activeStatus' => $request->string('status')->toString(),
        ]);
    }
}
