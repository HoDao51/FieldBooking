<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFieldRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'cluster_name' => 'required|string|max:255',
            'type_id' => 'required|exists:field_types,id',
            'status' => 'required|in:0,1',
            'conflict_fields' => 'nullable|array',
            'conflict_fields.*' => 'exists:fields,id',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_images' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sân không được để trống.',
            'name.string' => 'Tên sân phải là chuỗi ký tự.',
            'name.max' => 'Tên sân không được vượt quá 255 ký tự.',
            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'cluster_name.max' => 'Tên cụm sân không được vượt quá 255 ký tự.',
            'cluster_name.required' => 'Vui lòng nhập tên cụm sân.',
            'type_id.required' => 'Vui lòng chọn loại sân.',
            'type_id.exists' => 'Loại sân không tồn tại trong hệ thống.',
            'status.required' => 'Vui lòng chọn trạng thái sân.',
            'status.in' => 'Trạng thái sân không hợp lệ.',
            'conflict_fields.array' => 'Dữ liệu sân liên kết không hợp lệ.',
            'conflict_fields.*.exists' => 'Sân liên kết không tồn tại trong hệ thống.',
            'images.array' => 'Dữ liệu ảnh không hợp lệ.',
            'images.max' => 'Chỉ được tải lên tối đa 3 ảnh.',
            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',
            'images.*.max' => 'Mỗi ảnh không được vượt quá 2MB.',
            'delete_images.array' => 'Dữ liệu xóa ảnh không hợp lệ.',
        ];
    }
}
