<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class OrderController extends Controller
{
    use ResolvesDealer;

    public function index(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $orders = $this->baseQuery($dealer->id)
            ->when($request->filled('status'), fn ($query) => $query->where('order_status', $request->string('status')->toString()))
            ->when($request->filled('q'), function ($query) use ($request): void {
                $term = '%'.$request->string('q')->trim()->toString().'%';
                $query->where(function ($inner) use ($term): void {
                    $inner->where('order_number', 'like', $term)
                        ->orWhere('customer_name', 'like', $term)
                        ->orWhere('customer_phone', 'like', $term);
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('dealer.orders.index', [
            'orders' => $orders,
            'statuses' => OrderStatus::cases(),
            'activeStatus' => $request->string('status')->toString(),
        ]);
    }

    public function show(Request $request, Order $order): View
    {
        Gate::authorize('view', $order);

        $order->load(['landingPage', 'customer', 'cargoCompany', 'items.product', 'earning']);

        return view('dealer.orders.show', compact('order'));
    }

    public function cargo(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $orders = $this->baseQuery($dealer->id)
            ->whereNotNull('cargo_tracking_number')
            ->latest('shipped_at')
            ->paginate(15);

        return view('dealer.orders.cargo', compact('orders'));
    }

    private function baseQuery(int $dealerId)
    {
        return Order::query()
            ->with(['landingPage', 'cargoCompany'])
            ->forDealer($dealerId);
    }
}
