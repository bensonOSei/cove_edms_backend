<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmployeeCollection(Employee::paginate(10)->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // dd($request);
        DB::beginTransaction();

        try {
            // check if passport_pic is set
            if ($request->hasFile('passport_pic')) {
                $passport_pic = $request->file('passport_pic')->store('employee_passport_pics','public');
                $passport_pic = Storage::url($passport_pic);
            } else {
                $passport_pic = null;
            }
            

            // create employment from validated request
            $employment = Employment::create([
                'designation' => $request->designation,
                'job_grade' => $request->job_grade,
                'employee_type' => $request->employee_type,
                'branch' => $request->branch,
                'contract_freq_code' => $request->contract_freq_code,
                'contract_duration' => $request->contract_duration,
                'head_of_department' => $request->head_of_department,
            ]);

            // create employee from validated request
            $employee = Employee::create([
                'employment_id' => $employment->id,
                'title' => $request->title, // 'Mr', 'Mrs', 'Miss', 'Dr', 'Prof
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'other_names' => $request->other_names,
                'gender_code' => $request->gender_code,
                'TIN' => $request->TIN,
                'SSNIT_no' => $request->SSNIT_no,
                'date_of_birth' => $request->date_of_birth,
                'marital_status_code' => $request->marital_status_code,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'correspondence_address' => $request->correspondence_address,
                'passport_pic_path' => $passport_pic,
            ]);

            // commit transaction
            DB::commit();

            return response()->json([
                'message' => 'Employee data saved successfully',
                'data' => $employee,
            ], 201);



        } catch( \Exception $e) {

            // rollback transaction if any error occurs
            DB::rollback();

            // delete passport_pic if it was set
            if (isset($passport_pic)) {
                Storage::delete($passport_pic);
            }

            return response()->json([
                'message' => 'An error occurred while saving employee data',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        
        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
