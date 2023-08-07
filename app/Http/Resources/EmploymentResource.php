<?php

namespace App\Http\Resources;

use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->contract_freq_code);
        $contractFreqCode = match (intval($this->contract_freq_code)) {
            1 => "Daily",
            2 => "Weekly",
            3 => "Monthly",
            4 => "Yearly",
        };
        
        // format date
        $startAt = date_create($this->created_at);

        // calculate end_at from date created and duration
        $endAt = date_add($startAt, date_interval_create_from_date_string($this->contract_duration . " years"));
     
        return [
            'id' => $this->id,
            'designation' => $this->designation,
            'jobGrade' => $this->job_grade,
            'employeeType' => $this->employee_type,
            'branch' => $this->branch,
            'contractFreqCode' => $contractFreqCode,
            'contractDuration' => $this->contract_duration,
            'headOfDepartment' => $this->head_of_department,
            'startAt' => $startAt->format('Y-m-d'),
            'endAt' => $endAt->format('Y-m-d'),    
        ];
    }
}
