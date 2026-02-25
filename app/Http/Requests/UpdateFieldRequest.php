<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UpdateFieldRequest extends FormRequest
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
            ->withErrors($validator, 'edit')
            ->withInput()
            ->with('modal', 'edit');

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

            'delete_images' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            // Tên sân
            'name.required' => 'Tên sân không được để trống.',
            'name.string'   => 'Tên sân phải là chuỗi ký tự.',
            'name.max'      => 'Tên sân không được vượt quá 255 ký tự.',

            // Địa chỉ
            'address.required' => 'Địa chỉ không được để trống.',
            'address.string'   => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max'      => 'Địa chỉ không được vượt quá 255 ký tự.',

            // Loại sân
            'type_id.required' => 'Vui lòng chọn loại sân.',
            'type_id.exists'   => 'Loại sân không tồn tại trong hệ thống.',

            // Upload ảnh
            'images.array' => 'Dữ liệu ảnh không hợp lệ.',
            'images.max'   => 'Chỉ được tải lên tối đa 10 ảnh.',

            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',
            'images.*.max'   => 'Mỗi ảnh không được vượt quá 2MB.',

            // Xoá ảnh
            'delete_images.array' => 'Dữ liệu xoá ảnh không hợp lệ.',
        ];
    }
}
