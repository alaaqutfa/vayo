<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'specialty'         => 'required|string|max:255',
            'bio'               => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'years_experience'  => 'nullable|integer|min:0',
            'rating'            => 'nullable|numeric|min:0|max:5',
            'reviews_count'     => 'nullable|integer|min:0',
            'status'            => 'required|in:available,busy,offline',
            'service_id'        => 'nullable|exists:services,id',
            'order'             => 'nullable|integer|min:0',
            'is_active'         => 'boolean',
        ];
    }
}
