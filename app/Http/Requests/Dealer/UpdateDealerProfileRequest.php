<?php

namespace App\Http\Requests\Dealer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['nullable', 'string', 'max:191'],
            'display_name' => ['required', 'string', 'max:191'],
            'identity_number' => ['nullable', 'string', 'max:20'],
            'tax_number' => ['nullable', 'string', 'max:20'],
            'iban' => ['nullable', 'string', 'max:34'],
            'bank_name' => ['nullable', 'string', 'max:191'],
            'city' => ['nullable', 'string', 'max:80'],
            'district' => ['nullable', 'string', 'max:80'],
            'address' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url', 'max:191'],
            'facebook_url' => ['nullable', 'url', 'max:191'],
            'tiktok_url' => ['nullable', 'url', 'max:191'],
            'whatsapp_phone' => ['nullable', 'string', 'max:32'],
        ];
    }
}
