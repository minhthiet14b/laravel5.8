<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' =>'required',
            'content' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm không được trùng lập',
            'name.max' => 'Tên sản phẩm không quá 255 khí tự',
            'name.min' => 'Tên sản phẩm không ít hơn 10 kí tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'content.required' => 'Nội dung sản phẩm không được để trống',
        ];
    }
}
