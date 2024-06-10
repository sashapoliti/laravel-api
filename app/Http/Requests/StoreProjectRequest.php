<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200|min:3|unique:projects',
            'image' => 'nullable|image|max:1024',
            'description' => 'nullable',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Title already exists',
            'title.min' => 'Title must be at least :min characters',
            'title.max' => 'Title must be at most :max characters',
            'title.required' => 'Title is required',
            'image.max' => 'Image must be at most :max characters',
            'image.image' => 'Image must be an image',
            'type_id.exists' => 'Type not found',
            'technologies.exists' => 'Technology not found',
        ];
    }
}
