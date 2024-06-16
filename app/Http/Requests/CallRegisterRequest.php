<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallRegisterRequest extends FormRequest
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
            'organization_name' => 'required|min:5',
            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required',
        ];
    }
}
