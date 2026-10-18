<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductCategoryRequest;
use App\Http\Requests\Admin\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\SlugService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::withCount('products')
            ->latest()
            ->paginate(15);

        return view('admin.product-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.product-categories.create', [
            'category' => new ProductCategory(['is_active' => true]),
        ]);
    }

    public function store(StoreProductCategoryRequest $request, SlugService $slugService): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = ($data['slug'] ?? null) ?: $slugService->unique($data['name'], ProductCategory::class);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(fn () => ProductCategory::create($data));

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori kaydedildi.');
    }

    public function edit(ProductCategory $category): View
    {
        return view('admin.product-categories.edit', compact('category'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $category, SlugService $slugService): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = ($data['slug'] ?? null) ?: $slugService->unique($data['name'], ProductCategory::class, ignoreId: $category->id);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(fn () => $category->update($data));

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori güncellendi.');
    }
}
