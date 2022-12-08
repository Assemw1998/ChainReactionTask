<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;

class HrManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listEmployee()
    {
        $employees = Employee::all();
        if (!$employees->isEmpty()) {
            return ["data" => $employees, "message" => "data have been fetched successfully"];
        } else {
            return ["data" => $employees, "message" => "there is no employee yet"];
        }
        
    }

    public function addEmployee(Request $request)
    {
        $validation = [
            'email' => 'required|email',
            'phone_number' => 'required|min:10|max:10',
            'name' => 'required',
            'address' => 'required',
            'job_title' => 'required',
            'status' => 'required|numeric|min:0|max:1',
        ];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }else{
            return ["Employee"=>Employee::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "address"=>$request->address,
                "phone_number"=>$request->phone_number,
                "job_title"=>$request->job_title,
                "status"=>$request->status
            ]),"message" => "data have been added successfully"];
        }
    }

    public function deactivateEmployee($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->status=0;
            if($employee->save()){
                return response()->json(['id' => $id, 'message' => 'Employee has been deactived successfully'], 200); 
            }else{
                return response()->json(['id' => $id, 'message' => 'something went wrong please try again later'], 500); 
            }
        } else {
            return response()->json(['id' => $id, 'message' => 'This id is not found'], 404);
        }
    }
}
