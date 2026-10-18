<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DealerStatus;
use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $metrics = [
            'total_dealers' => DealerProfile::count(),
            'active_dealers' => DealerProfile::where('status', DealerStatus::Approved->value)->count(),
            'pending_dealers' => DealerProfile::where('status', DealerStatus::Pending->value)->count(),
            'total_users' => User::count(),
            'today_orders' => 0,
            'total_orders' => 0,
            'total_revenue' => '0,00 TL',
            'dealer_earnings' => '0,00 TL',
            'center_profit' => '0,00 TL',
        ];

        return view('admin.dashboard', compact('metrics'));
    }
}
