<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {return true;}

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'content'          => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'        => 'boolean',
            'order'            => 'integer|min:0',
        ];
    }
}
