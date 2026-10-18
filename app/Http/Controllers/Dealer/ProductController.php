<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Http\Requests\Dealer\UpdateDealerProductPriceRequest;
use App\Models\DealerProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ResolvesDealer;

    public function index(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $products = DealerProduct::query()
            ->with(['product.category', 'productPrice'])
            ->forDealer($dealer->id)
            ->when($request->filled('status'), fn ($query) => $query->where('is_enabled', $request->string('status')->toString() === 'active'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('dealer.products.index', compact('dealer', 'products'));
    }

    public function updatePrice(UpdateDealerProductPriceRequest $request, DealerProduct $dealerProduct): RedirectResponse
    {
        Gate::authorize('update', $dealerProduct);

        DB::transaction(function () use ($request, $dealerProduct): void {
            $dealerProduct->update([
                'custom_sale_price' => $request->input('custom_sale_price'),
                'is_enabled' => $request->boolean('is_enabled'),
            ]);
        });

        return back()->with('status', 'Ürün satış ayarı güncellendi.');
    }
}
