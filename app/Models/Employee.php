<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'employment_id',
        'title',
        'first_name',
        'last_name',
        'other_names',
        'gender_code',
        'TIN',
        'SSNIT_no',
        'date_of_birth',
        'marital_status_code',
        'email',
        'phone_number',
        'correspondence_address',
        'passport_pic_path',
    ];

    public function employment(){
        return $this->belongsTo(Employment::class);
    }
}
