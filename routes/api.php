<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\HrManagerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Employee APIS
Route::put('employee/v1/update-contact-infromation/{id}',[employeeController::class, 'updateContactInfromation']);

#HR Manager APIS
Route::get('hr-manager/v1/list-employee',[HrManagerController::class, 'listEmployee']);
Route::post('hr-manager/v1/add-employee',[HrManagerController::class, 'addEmployee']);
Route::put('hr-manager/v1/deactivate-employee/{id}',[HrManagerController::class, 'deactivateEmployee']);
