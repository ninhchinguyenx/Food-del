<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'nullable|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Tên không được để trống!',
            'img.required' => 'Ảnh không được để trống!',
            'img.image' => 'Tệp tải lên phải là ảnh!',
            'img.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif!',
            'img.max' => 'Dung lượng ảnh không được vượt quá 2MB!',
        ];
    }
}
