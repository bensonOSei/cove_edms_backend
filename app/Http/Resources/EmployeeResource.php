<?php

namespace App\Http\Resources;

use App\Models\Employment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($request->contract_freq_code);
        $gender = match ($this->gender_code) {
            1 => "Male",
            2 => "Female",
        };

        $maritalStatus = match ($this->marital_status_code) {
            1 => "Single",
            2 => "Married",
            3 => "Divorced",
            4 => "Widowed",
        };

        // calculate age
        $dateOfBirth = date_create($this->date_of_birth);
        $now = date_create(date('Y-m-d'));
        $age = date_diff($dateOfBirth, $now)->y;

        return [
            'id' => $this->id,
            'employment' => new EmploymentResource(Employment::find($this->employment_id)),
            'title' => $this->title,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'otherName' => $this->other_names,
            'gender' => $gender,
            'TIN' => $this->TIN,
            'SSNIT' => $this->SSNIT_no,
            'dateOfBirth' => $this->date_of_birth,
            'age' => $age,
            'maritalStatus' => $maritalStatus,
            'email' => $this->email,
            'phoneNumber' => $this->phone_number,
            'correspondenceAddress' => $this->correspondence_address,
            'passportPicPath' => $this->passport_pic_path,
        ];
    }
}
