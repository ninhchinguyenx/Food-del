<?php

namespace App\Http\Requests\Admin\Product;

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
        $productId = $this->route('product') ? $this->route('product')->id : null;
        return [
            'name' => 'required|max:255|unique:products,name,' . $productId,
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
            'category'=>'required',
            'price_regular' => 'required',
            'price_sale' => 'required',
            'quantity' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name' => 'Tên không được để trống!',
            'img.required' => 'Ảnh không được để trống!',
            'tags.required' => 'Tags không được để trống!',
            'category.required' => 'Danh mục không được để trống!',
            'price_regular.required' => 'Giá không được để trống!',
            'price_sale.required' => 'Giá sale không được để trống!',
            'quantity.required' => 'Số lượng không được để trống!',
            'img.image' => 'Tệp tải lên phải là ảnh!',
            'img.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif!',
            'img.max' => 'Dung lượng ảnh không được vượt quá 2MB!',
        ];
    }
}
