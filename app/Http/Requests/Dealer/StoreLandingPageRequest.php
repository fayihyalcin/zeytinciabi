<?php

namespace App\Http\Requests\Dealer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreLandingPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'string', 'max:191'],
            'headline' => ['nullable', 'string', 'max:191'],
            'subheadline' => ['nullable', 'string', 'max:191'],
            'description' => ['nullable', 'string'],
            'whatsapp_phone' => ['nullable', 'string', 'max:32'],
            'facebook_pixel_id' => ['nullable', 'string', 'max:191'],
            'tiktok_pixel_id' => ['nullable', 'string', 'max:191'],
            'google_tag_id' => ['nullable', 'string', 'max:191'],
            'custom_css' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'products' => ['required', 'array'],
            'products.*.dealer_product_id' => ['required', 'integer'],
            'products.*.sale_price' => ['required', 'numeric', 'min:0'],
            'products.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'products.*.is_active' => ['nullable', 'boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $hasActiveProduct = collect($this->input('products', []))
                    ->contains(fn (array $product): bool => filter_var($product['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN));

                if (! $hasActiveProduct) {
                    $validator->errors()->add('products', 'Landing page için en az bir ürün seçmelisiniz.');
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
