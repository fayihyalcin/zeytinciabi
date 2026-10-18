<?php

namespace App\Http\Requests\Admin;

use App\Enums\StockStatus;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAdminAccess() === true;
    }

    public function rules(): array
    {
        /** @var Product $product */
        $product = $this->route('product');

        return [
            'product_category_id' => ['nullable', 'exists:product_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product)],
            'sku' => ['nullable', 'string', 'max:80', Rule::unique('products', 'sku')->ignore($product)],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'main_image' => ['nullable', 'string', 'max:255'],
            'volume_liter' => ['nullable', 'numeric', 'min:0'],
            'package_type' => ['nullable', 'string', 'max:80'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            'stock_status' => ['required', Rule::enum(StockStatus::class)],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
