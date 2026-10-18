<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealerPayout;
use Illuminate\View\View;

class PayoutController extends Controller
{
    public function index(): View
    {
        $payouts = DealerPayout::with('dealer')
            ->latest()
            ->paginate(20);

        return view('admin.payouts.index', compact('payouts'));
    }
}
