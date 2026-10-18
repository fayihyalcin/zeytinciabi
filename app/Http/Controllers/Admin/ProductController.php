<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StockStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\SlugService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['category', 'prices'])
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product([
                'is_active' => true,
                'stock_status' => StockStatus::InStock,
            ]),
            'categories' => ProductCategory::orderBy('name')->get(),
            'stockStatuses' => StockStatus::cases(),
        ]);
    }

    public function store(StoreProductRequest $request, SlugService $slugService): RedirectResponse
    {
        $data = $this->normalizedData($request->validated(), $request->boolean('is_active'));
        $data['slug'] = ($data['slug'] ?? null) ?: $slugService->unique($data['name'], Product::class);

        DB::transaction(fn () => Product::create($data));

        return redirect()->route('admin.products.index')->with('status', 'Ürün kaydedildi.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => ProductCategory::orderBy('name')->get(),
            'stockStatuses' => StockStatus::cases(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product, SlugService $slugService): RedirectResponse
    {
        $data = $this->normalizedData($request->validated(), $request->boolean('is_active'));
        $data['slug'] = ($data['slug'] ?? null) ?: $slugService->unique($data['name'], Product::class, ignoreId: $product->id);

        DB::transaction(fn () => $product->update($data));

        return redirect()->route('admin.products.index')->with('status', 'Ürün güncellendi.');
    }

    private function normalizedData(array $data, bool $isActive): array
    {
        $data['is_active'] = $isActive;
        $data['stock_quantity'] = $data['stock_quantity'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
