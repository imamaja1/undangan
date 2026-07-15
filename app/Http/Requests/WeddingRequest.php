<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeddingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'couple' => 'required|array',
            'wedding_info' => 'required|array',
            'quotes' => 'required|array',
            'wa_number' => 'nullable|string|max:20',
            'sections' => 'required|array',
        ];
    }
}
