<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['dealer', 'landingPage', 'customer'])
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['dealer.user', 'landingPage', 'customer', 'cargoCompany', 'items.product', 'earning']);

        return view('admin.orders.show', compact('order'));
    }
}
