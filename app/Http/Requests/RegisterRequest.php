<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'phoneNumber' => 'required|regex:/^[0-9]{10}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại. Vui lòng nhập email khác.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'phoneNumber.required' => 'Vui lòng nhập số điện thoại.',
            'phoneNumber.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.',
        ];
    }
}
