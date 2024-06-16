<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookAppointmentRequest extends FormRequest
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
            'institute_id' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'appointment_date' => 'required',
            'appointment_timing'=>'required',
            'remarks'=>'required',
            
        ];
    }
}
