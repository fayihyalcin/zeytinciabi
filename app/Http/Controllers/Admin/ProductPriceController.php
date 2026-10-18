<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductPriceRequest;
use App\Http\Requests\Admin\UpdateProductPriceRequest;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductPriceController extends Controller
{
    public function index(): View
    {
        $prices = ProductPrice::with('product')
            ->latest()
            ->paginate(20);

        return view('admin.product-prices.index', compact('prices'));
    }

    public function create(): View
    {
        return view('admin.product-prices.create', [
            'price' => new ProductPrice([
                'currency' => 'TRY',
                'is_active' => true,
            ]),
            'products' => Product::active()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreProductPriceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        DB::transaction(fn () => ProductPrice::create($data));

        return redirect()->route('admin.product-prices.index')->with('status', 'Fiyat kaydedildi.');
    }

    public function edit(ProductPrice $productPrice): View
    {
        return view('admin.product-prices.edit', [
            'price' => $productPrice,
            'products' => Product::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateProductPriceRequest $request, ProductPrice $productPrice): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        DB::transaction(fn () => $productPrice->update($data));

        return redirect()->route('admin.product-prices.index')->with('status', 'Fiyat güncellendi.');
    }
}
