<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string',
            'phoneNumber' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'phoneNumber.required' => 'Vui lòng nhập số điện thoại.',
            'phoneNumber.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại. Vui lòng nhập email khác.'
        ];
    }
}
