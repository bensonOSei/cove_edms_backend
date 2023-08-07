<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable=[
        'designation',
        'job_grade',
        'employee_type',
        'branch',
        'contract_freq_code',
        'contract_duration',
        'head_of_department',
    ];
}
