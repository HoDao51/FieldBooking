<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_type' => 'required|in:existing,guest',
            'customer_id' => 'nullable|required_if:customer_type,existing|exists:customers,id',
            'contactName' => 'required|string',
            'contactEmail' => 'required|email',
            'contactPhone' => 'required|regex:/^[0-9]{10}$/',
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'time_id' => 'required|exists:time_slots,id',
            'price' => 'required|numeric|min:1',
            'payment_id' => 'required|exists:payment_methods,id',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_type.required' => 'Vui lòng chọn loại khách hàng.',
            'customer_type.in' => 'Loại khách hàng không hợp lệ.',
            'customer_id.required_if' => 'Vui lòng chọn khách hàng.',
            'customer_id.exists' => 'Khách hàng không tồn tại.',
            'contactName.required' => 'Vui lòng nhập họ tên khách hàng.',
            'contactEmail.required' => 'Vui lòng nhập email khách hàng.',
            'contactEmail.email' => 'Email khách hàng không hợp lệ.',
            'contactPhone.required' => 'Vui lòng nhập số điện thoại khách hàng.',
            'contactPhone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.',
            'field_id.required' => 'Vui lòng chọn sân.',
            'field_id.exists' => 'Sân không tồn tại.',
            'date.required' => 'Vui lòng chọn ngày đặt sân.',
            'date.date' => 'Ngày đặt sân không hợp lệ.',
            'time_id.required' => 'Vui lòng chọn khung giờ.',
            'time_id.exists' => 'Khung giờ không tồn tại.',
            'price.required' => 'Vui lòng chọn khung giờ để lấy giá tiền.',
            'price.numeric' => 'Giá tiền không hợp lệ.',
            'payment_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_id.exists' => 'Phương thức thanh toán không tồn tại.',
        ];
    }
}
