<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreFieldRequest extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        $response = redirect()
            ->back()
            ->withErrors($validator, 'create')
            ->withInput()
            ->with('modal', 'create');

        throw new HttpResponseException($response);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'address' => 'required|string|max:255',

            'type_id' => 'required|exists:field_types,id',

            'images' => 'nullable|array|max:10',

            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sân.',
            'name.max' => 'Tên sân không được vượt quá 255 ký tự.',

            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'type_id.required' => 'Vui lòng chọn loại sân.',
            'type_id.exists' => 'Loại sân không hợp lệ.',

            'images.array' => 'Dữ liệu ảnh không hợp lệ.',
            'images.max' => 'Chỉ được tải lên tối đa 10 ảnh.',

            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',
            'images.*.max' => 'Mỗi ảnh không được vượt quá 2MB.',
        ];
    }
}
