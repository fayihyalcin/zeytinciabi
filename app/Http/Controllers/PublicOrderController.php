<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicOrderRequest;
use App\Models\LandingPage;
use App\Services\OrderIntakeService;
use Illuminate\Http\RedirectResponse;

class PublicOrderController extends Controller
{
    public function store(StorePublicOrderRequest $request, LandingPage $landingPage, OrderIntakeService $orderIntakeService): RedirectResponse
    {
        $order = $orderIntakeService->createFromLandingPage($landingPage, $request->validated());

        return redirect()
            ->route('public.landing.show', $landingPage)
            ->with('status', "Siparişiniz alındı. Sipariş no: {$order->order_number}");
    }
}
