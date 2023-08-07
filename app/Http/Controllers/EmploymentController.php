<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmploymentResource;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function show(Employment $employment)
    {
        return new EmploymentResource($employment);
    }
}
