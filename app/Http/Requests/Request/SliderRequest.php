<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name' => 'required|max:255|unique:slider',
            'image_path' => 'required',
            'content' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên slider không được bỏ trống',
            'name.max' => 'Tên slider không quá 255 kí tự',
            'name.unique' => 'Tên slider bị trùng lập',
            'image_path.required' => 'Hình ảnh bị thiếu',
            'content.required' => 'Nội dung bị thiếu',
        ];
    }
}
