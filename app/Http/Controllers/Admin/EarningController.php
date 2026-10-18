<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealerEarning;
use Illuminate\View\View;

class EarningController extends Controller
{
    public function index(): View
    {
        $earnings = DealerEarning::with(['dealer', 'order'])
            ->latest()
            ->paginate(20);

        return view('admin.earnings.index', compact('earnings'));
    }
}
