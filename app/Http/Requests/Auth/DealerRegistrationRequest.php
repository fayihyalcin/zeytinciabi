<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class DealerRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'required_without:phone', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:32', 'required_without:email', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['nullable', 'string', 'max:255'],
            'display_name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:32'],
            'tax_number' => ['nullable', 'string', 'max:32'],
            'iban' => ['nullable', 'string', 'max:34'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:80'],
            'district' => ['nullable', 'string', 'max:80'],
            'address' => ['nullable', 'string', 'max:1000'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'whatsapp_phone' => ['nullable', 'string', 'max:32'],
        ];
    }
}
