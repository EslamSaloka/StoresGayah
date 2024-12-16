<?php

namespace App\Http\Requests\Ecommerce\CheckOut;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            "address_id"        => "required|numeric",
            "payment_type"      => "required",
            "image"             => "required_if:payment_type,bank|image",
        ];
    }

    public function messages() {
        return [
            "address_id.required" => "العنوان مطلوب",
            "address_id.numeric" => "العنوان يجب ان يكون رقما",
            "image.required_if" => "إرفاق إيصال التحويل مطلوب في حال ما إذا كان طريقة الدفع تحويل بنكي",
        ];
    }
}
