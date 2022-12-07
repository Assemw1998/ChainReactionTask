<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateContactInfromation(Request $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $validation = [
                'email' => 'email',
                'phone_number' => 'min:10|max:10'
            ];
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                return response()->json(['id' => $id, 'message' => $validator->errors()], 400);
            } else {
                if(isset($request->status) || isset($request->job_title) ){
                    return response()->json(['id' => $id, 'message' => "You don't have permission to update these fields"], 401);
                    
                }else{

                    $employee->update($request->all());
                    return response()->json(['id' => $id, 'message' => 'Contact information has been updated successfully'], 200);
                }
                
            }
        } else {
            return response()->json(['id' => $id, 'message' => 'This id is not found'], 404);
        }
    }
}
