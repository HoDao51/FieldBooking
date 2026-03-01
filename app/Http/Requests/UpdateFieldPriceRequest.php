<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UpdateFieldPriceRequest extends FormRequest
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
            ->withErrors($validator, 'edit')
            ->withInput()
            ->with('modal', 'edit');

        throw new HttpResponseException($response);
    }
    
    public function rules(): array
    {
        $fieldPriceId = $this->route('cauHinhGiaGio'); 
        // nếu dùng Route::resource('admins/cauHinhGiaGio', ...)

        return [
            'field_id' => [
                'required',
                'exists:fields,id'
            ],

            'time_id' => [
                'required',
                'exists:time_slots,id',
                Rule::unique('field_prices')
                    ->ignore($fieldPriceId)
                    ->where(fn ($query) =>
                        $query->where('field_id', $this->field_id)
                              ->where('day_of_week', $this->day_of_week)
                    )
            ],

            'day_of_week' => [
                'required',
                'integer',
                'between:0,6'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:1000000'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'field_id.required' => 'Vui lòng chọn sân.',
            'field_id.exists'   => 'Sân không tồn tại.',

            'time_id.required' => 'Vui lòng chọn khung giờ.',
            'time_id.exists'   => 'Khung giờ không tồn tại.',
            'time_id.unique'   => 'Khung giờ này đã được cấu hình giá theo ngày đã chọn.',

            'day_of_week.required' => 'Vui lòng chọn ngày trong tuần.',
            'day_of_week.between'  => 'Ngày trong tuần không hợp lệ.',

            'price.required' => 'Vui lòng nhập giá.',
            'price.numeric'  => 'Giá phải là số.',
            'price.min'      => 'Giá phải lớn hơn hoặc bằng 0.',
            'price.max'      => 'Giá không quá 1 triệu',
        ];
    }
}
