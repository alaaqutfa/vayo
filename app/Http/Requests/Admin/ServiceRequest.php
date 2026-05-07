<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // سيتم التحقق من الأدمن عبر middleware
    }

    public function rules(): array
    {
        $rules = [
            'category_id' => 'nullable|exists:guide_categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'features'    => 'nullable|array',
            'features.*'  => 'string|max:255',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Service name is required.',
            'description.required' => 'Service description is required.',
            'image.image'          => 'The file must be an image.',
            'image.max'            => 'Image size must not exceed 2MB.',
        ];
    }
}
