<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerEarning;
use App\Models\DealerProduct;
use App\Models\LandingPage;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $dealer = request()->user()->dealerProfile()->firstOrFail();

        $ordersQuery = Order::forDealer($dealer->id);
        $earningsQuery = DealerEarning::forDealer($dealer->id);

        $metrics = [
            'total_orders' => (clone $ordersQuery)->count(),
            'today_orders' => (clone $ordersQuery)->whereDate('created_at', today())->count(),
            'total_revenue' => (clone $ordersQuery)->sum('total_amount'),
            'total_profit' => (clone $ordersQuery)->sum('dealer_total_profit'),
            'pending_earnings' => (clone $earningsQuery)->whereIn('status', ['pending', 'approved', 'payable'])->sum('amount'),
            'paid_earnings' => (clone $earningsQuery)->where('status', 'paid')->sum('amount'),
            'active_landing_pages' => LandingPage::forDealer($dealer->id)->active()->count(),
            'dealer_products' => DealerProduct::forDealer($dealer->id)->where('is_enabled', true)->count(),
        ];

        $statusCounts = (clone $ordersQuery)
            ->selectRaw('order_status, COUNT(*) as total')
            ->groupBy('order_status')
            ->pluck('total', 'order_status');

        $recentOrders = (clone $ordersQuery)
            ->with(['landingPage', 'items'])
            ->latest()
            ->limit(6)
            ->get();

        $landingPages = LandingPage::forDealer($dealer->id)
            ->withCount('orders')
            ->latest()
            ->limit(5)
            ->get();

        return view('dealer.dashboard', compact('dealer', 'metrics', 'statusCounts', 'recentOrders', 'landingPages'));
    }
}
