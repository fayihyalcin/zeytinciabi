<?php

namespace App\Http\Requests\Dealer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealerProductPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dealerProduct = $this->route('dealerProduct');
        $price = $dealerProduct?->productPrice;
        $min = $price?->min_sale_price;
        $max = $price?->max_sale_price;

        return [
            'custom_sale_price' => array_filter(['required', 'numeric', 'min:0', $min ? 'gte:'.$min : null, $max ? 'lte:'.$max : null]),
            'is_enabled' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_enabled' => $this->boolean('is_enabled'),
        ]);
    }
}
