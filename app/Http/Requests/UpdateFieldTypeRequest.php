<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateFieldTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('field_types', 'name')->ignore($this->route('loaiSan')?->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên loại sân.',
            'name.max' => 'Tên loại sân không được vượt quá 20 ký tự.',
            'name.unique' => 'Tên loại sân đã tồn tại.',
        ];
    }
}
