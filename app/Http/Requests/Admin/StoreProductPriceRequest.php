<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAdminAccess() === true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'normal_sale_price' => ['required', 'numeric', 'min:0.01'],
            'dealer_buy_price' => ['required', 'numeric', 'min:0.01'],
            'suggested_sale_price' => ['required', 'numeric', 'min:0.01'],
            'min_sale_price' => ['required', 'numeric', 'min:0.01'],
            'max_sale_price' => ['nullable', 'numeric', 'gte:min_sale_price'],
            'currency' => ['required', 'string', 'size:3'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }
}
