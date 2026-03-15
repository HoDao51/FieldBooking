<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'time_id' => [
                'required',
                Rule::unique('bookings')->where(function ($query) {
                    return $query
                        ->where('field_id', request('field_id'))
                        ->where('date', request('date'));
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'time_id.required' => 'Vui lòng chọn thời gian.',
            'time_id.unique' => 'Khung giờ này đã được đặt.',
        ];
    }
}
