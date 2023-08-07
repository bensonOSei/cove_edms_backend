<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'title'=> 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_names' => 'nullable|string',
            'TIN' => 'required|string',
            'SSNIT_no' => 'required|string',
            'date_of_birth' => 'required|date',
            'marital_status_code' => 'nullable|string',
            'email' => 'nullable|email|unique:employees',
            'phone_number' => 'required|string',
            'correspondence_address' => 'nullable|string',
            'passport_pic' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'designation' => 'required|string',
            'job_grade' => 'required|string',
            'employee_type' => 'required|string',
            'branch' => 'required|string',
            'contract_freq_code' => 'required|int',
            'contract_duration' => 'required|int',
            'head_of_department' => 'required|string',
        ];
        
    }
}
