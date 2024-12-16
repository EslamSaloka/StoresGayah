<?php

namespace App\Http\Requests\Ecommerce\Profile;

use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
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
            "shipping_by"   => "required",
            "city"          => "required",
            'title'         => "required",
            'address'       => "required|max:50",
            'postcode'      => "required|numeric",
            'phone'         => "required|numeric",
        ];
    }

    public function messages() {
        return [
            "phone.required" => "رقم الشقه مطلوب",
            "phone.numeric" => "رقم الشقه يجب ان يكون رقما",
            "postcode.required" => "الرمز البريدي مطلوب",
            "postcode.numeric" => "الرمز البريدي يجب ان يكون رقما",
        ];
    }
}
