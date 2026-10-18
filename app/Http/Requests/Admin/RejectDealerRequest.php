<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RejectDealerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAdminAccess() === true;
    }

    public function rules(): array
    {
        return [
            'rejected_reason' => ['required', 'string', 'max:1000'],
        ];
    }
}
