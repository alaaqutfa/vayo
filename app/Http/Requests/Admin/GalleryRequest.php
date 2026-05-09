<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title'       => 'nullable|string|max:255',
            'type'        => 'required|in:image,video',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ];

        if ($this->input('type') === 'image') {
            $rules['image']        = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120';
            $rules['before_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120';
            $rules['after_image']  = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120';
        } else {
            $rules['video_url'] = 'required|url|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required'      => 'Please select image or video type.',
            'image.image'        => 'The file must be an image.',
            'video_url.required' => 'Video URL is required for video type.',
            'video_url.url'      => 'Please enter a valid video URL.',
        ];
    }
}
