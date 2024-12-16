<?php

namespace App\Http\Requests\Ecommerce\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactStore extends FormRequest
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
            "name"  => "required",
            "email"  => "required|email",
            "phone"  => "required|numeric|digits:10|regex:/(05)[0-9]{8}/|not_regex:/[a-z]/",
            "message"  => "required",
        ];
    }
}
