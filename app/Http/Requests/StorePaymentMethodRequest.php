<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePaymentMethodRequest extends FormRequest
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
            ->withErrors($validator, 'create')
            ->withInput()
            ->with('modal', 'create');

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
            'name' => 'required|string|max:100|unique:payment_methods,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên phương thức thanh toán.',
            'name.max' => 'Tên phương thức thanh toán không được vượt quá 100 ký tự.',
            'name.unique' => 'Tên phương thức thanh toán đã tồn tại.',
        ];
    }
}
