<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'img_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
            'category'=>'required',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => [
                'required',
                'numeric',
                'lt:price_regular',
            ],
            'quantity' => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name' => 'Tên không được để trống!',
            'img_thumbnail.required' => 'Ảnh không được để trống!',
            'tags.required' => 'Tags không được để trống!',
            'category.required' => 'Danh mục không được để trống!',
            'price_regular.required' => 'Giá không được để trống!',
            'price_sale.required' => 'Giá sale không được để trống!',
            'quantity.required' => 'Số lượng không được để trống!',
            'img_thumbnail.image' => 'Tệp tải lên phải là ảnh!',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'img_thumbnail.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif!',
            'img_thumbnail.max' => 'Dung lượng ảnh không được vượt quá 2MB!',
        ];
    }
}
