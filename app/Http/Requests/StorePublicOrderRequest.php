<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicOrderRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $items = collect($this->input('items', []))
            ->filter(fn (mixed $item): bool => is_array($item) && (int) ($item['quantity'] ?? 0) > 0)
            ->values()
            ->all();

        $this->merge(['items' => $items]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:32'],
            'customer_city' => ['required', 'string', 'max:80'],
            'customer_district' => ['required', 'string', 'max:80'],
            'customer_address' => ['required', 'string', 'max:1000'],
            'customer_note' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.landing_page_product_id' => ['required', 'integer', 'exists:landing_page_products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }
}
