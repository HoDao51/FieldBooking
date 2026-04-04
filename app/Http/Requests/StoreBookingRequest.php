<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contactName' => 'required|string',
            'contactEmail' => 'required|email',
            'contactPhone' => 'required|regex:/^[0-9]{10}$/',
            'field_id' => 'required',
            'date' => 'required|date',
            'time_id' => 'required',
            'price' => 'required|numeric|min:1',
            'payment_id' => 'required',
            'payment_type' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'contactName.required' => 'Vui lòng nhập họ tên.',
            'contactEmail.required' => 'Vui lòng nhập email.',
            'contactEmail.email' => 'Email không hợp lệ.',
            'contactPhone.required' => 'Vui lòng nhập số điện thoại.',
            'contactPhone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.',
            'field_id.required' => 'Vui lòng chọn sân.',
            'date.required' => 'Vui lòng chọn ngày đặt sân.',
            'date.date' => 'Ngày đặt sân không hợp lệ.',
            'time_id.required' => 'Vui lòng chọn khung giờ.',
            'price.required' => 'Không tìm thấy giá tiền của khung giờ đã chọn.',
            'price.numeric' => 'Giá tiền không hợp lệ.',
            'payment_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_type.required' => 'Vui lòng chọn hình thức thanh toán.',
            'payment_type.in' => 'Hình thức thanh toán không hợp lệ.',
        ];
    }
}
