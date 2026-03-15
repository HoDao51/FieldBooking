<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'contactName' => 'required|string',
            'contactEmail' => 'required|email',
            'contactPhone' => 'required|regex:/^[0-9]{10}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'contactName.required' => 'Vui lòng nhập họ tên.',
            'contactEmail.required' => 'Vui lòng nhập email.',
            'contactEmail.email' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'contactPhone.required' => 'Vui lòng nhập số điện thoại.',
            'contactPhone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.',
        ];
    }
}
