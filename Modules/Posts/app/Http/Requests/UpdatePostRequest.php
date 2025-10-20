<?php

namespace Modules\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title',
            'content.required' => 'Please enter content',
            'category_id.required' => 'Please select category',
            'status.required' => 'Please select a status',
            'image.image' => 'File must be an image',
            'image.max' => 'Image size cannot exceed 2MB',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
