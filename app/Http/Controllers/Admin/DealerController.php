<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DealerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApproveDealerRequest;
use App\Http\Requests\Admin\RejectDealerRequest;
use App\Models\DealerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DealerController extends Controller
{
    public function index(): View
    {
        $dealers = DealerProfile::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.dealers.index', compact('dealers'));
    }

    public function pending(): View
    {
        $dealers = DealerProfile::with('user')
            ->where('status', DealerStatus::Pending)
            ->latest()
            ->paginate(20);

        return view('admin.dealers.index', [
            'dealers' => $dealers,
            'onlyPending' => true,
        ]);
    }

    public function show(DealerProfile $dealer): View
    {
        $dealer->loadCount(['dealerProducts', 'landingPages', 'orders', 'earnings', 'payouts'])->load('user');

        return view('admin.dealers.show', compact('dealer'));
    }

    public function approve(ApproveDealerRequest $request, DealerProfile $dealer): RedirectResponse
    {
        DB::transaction(function () use ($dealer): void {
            $dealer->update([
                'status' => DealerStatus::Approved,
                'approved_at' => now(),
                'rejected_at' => null,
                'rejected_reason' => null,
            ]);
        });

        return back()->with('status', 'Bayi onaylandı.');
    }

    public function reject(RejectDealerRequest $request, DealerProfile $dealer): RedirectResponse
    {
        DB::transaction(function () use ($request, $dealer): void {
            $dealer->update([
                'status' => DealerStatus::Rejected,
                'approved_at' => null,
                'rejected_at' => now(),
                'rejected_reason' => $request->validated('rejected_reason'),
            ]);
        });

        return back()->with('status', 'Bayi başvurusu reddedildi.');
    }
}
