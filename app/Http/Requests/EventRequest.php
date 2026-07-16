<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'akad.title' => 'required|string|max:255',
            'akad.icon' => 'nullable|string|max:50',
            'akad.date' => 'required|string|max:255',
            'akad.time' => 'required|string|max:255',
            'akad.venue' => 'required|string|max:255',
            'akad.address' => 'required|string',
            'akad.calendar_link' => 'nullable|string|max:500',
            'resepsi.title' => 'required|string|max:255',
            'resepsi.icon' => 'nullable|string|max:50',
            'resepsi.date' => 'required|string|max:255',
            'resepsi.time' => 'required|string|max:255',
            'resepsi.venue' => 'required|string|max:255',
            'resepsi.address' => 'required|string',
            'resepsi.calendar_link' => 'nullable|string|max:500',
        ];
    }
}
