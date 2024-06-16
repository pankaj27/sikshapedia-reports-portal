<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRegisterRequest extends FormRequest
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
            'institute_name' => 'required',
            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'mobile_1' => 'required|numeric|digits:10',
            'institution_email_id' => 'required|email',
            'institution_address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'city' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'state_id' => 'required',
            'district_id' => 'required',
            'pin' => 'required|numeric|digits:6',
            'visit_date' => 'required',
            'appointment_time' => 'required',
            'special_note' => 'required',            
            'status' => 'required',
        ];
    }
}
