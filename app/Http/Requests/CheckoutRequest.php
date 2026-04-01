<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'field_id' => 'required',
            'date' => 'required|date',
            'time_id' => 'required',
            'price' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'field_id.required' => 'Vui lòng chọn sân.',
            'date.required' => 'Vui lòng chọn ngày đặt sân.',
            'date.date' => 'Ngày đặt sân không hợp lệ.',
            'time_id.required' => 'Vui lòng chọn thời gian.',
            'price.required' => 'Không tìm thấy giá của khung giờ đã chọn.',
            'price.numeric' => 'Giá tiền không hợp lệ.',
        ];
    }
}
