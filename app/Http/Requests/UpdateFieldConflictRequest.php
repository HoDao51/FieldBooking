<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFieldConflictRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'conflict_fields' => 'nullable|array',
            'conflict_fields.*' => 'exists:fields,id',
        ];
    }

    public function messages(): array
    {
        return [
            'conflict_fields.array' => 'Dữ liệu sân liên kết không hợp lệ.',
            'conflict_fields.*.exists' => 'Sân liên kết không tồn tại.',
        ];
    }
}
