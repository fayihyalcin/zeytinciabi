<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dealer\Concerns\ResolvesDealer;
use App\Http\Requests\Dealer\StoreLandingPageRequest;
use App\Http\Requests\Dealer\UpdateLandingPageRequest;
use App\Models\DealerProduct;
use App\Models\LandingPage;
use App\Services\LandingPageBuilderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    use ResolvesDealer;

    public function index(Request $request): View
    {
        $dealer = $this->currentDealer($request);

        $landingPages = LandingPage::query()
            ->withCount('orders')
            ->forDealer($dealer->id)
            ->latest()
            ->paginate(12);

        return view('dealer.landing-pages.index', compact('dealer', 'landingPages'));
    }

    public function create(Request $request): View
    {
        $dealer = $this->currentDealer($request);
        $dealerProducts = $this->availableProducts($dealer->id);

        return view('dealer.landing-pages.create', [
            'landingPage' => new LandingPage(['is_active' => true]),
            'dealerProducts' => $dealerProducts,
        ]);
    }

    public function store(StoreLandingPageRequest $request, LandingPageBuilderService $builder): RedirectResponse
    {
        $dealer = $this->currentDealer($request);

        $landingPage = $builder->create($dealer, $request->validated());

        return redirect()
            ->route('dealer.landing-pages.edit', $landingPage)
            ->with('status', 'Landing page oluşturuldu.');
    }

    public function edit(Request $request, LandingPage $landingPage): View
    {
        Gate::authorize('update', $landingPage);

        $dealer = $this->currentDealer($request);
        $landingPage->load('landingPageProducts.dealerProduct.productPrice', 'landingPageProducts.product');

        return view('dealer.landing-pages.edit', [
            'landingPage' => $landingPage,
            'dealerProducts' => $this->availableProducts($dealer->id),
        ]);
    }

    public function update(UpdateLandingPageRequest $request, LandingPage $landingPage, LandingPageBuilderService $builder): RedirectResponse
    {
        Gate::authorize('update', $landingPage);

        $builder->update($landingPage, $request->validated());

        return redirect()
            ->route('dealer.landing-pages.edit', $landingPage)
            ->with('status', 'Landing page güncellendi.');
    }

    private function availableProducts(int $dealerId)
    {
        return DealerProduct::query()
            ->with(['product', 'productPrice'])
            ->forDealer($dealerId)
            ->where('is_enabled', true)
            ->whereHas('product', fn ($query) => $query->where('is_active', true))
            ->whereHas('productPrice', fn ($query) => $query->where('is_active', true))
            ->orderByDesc('updated_at')
            ->get();
    }
}
