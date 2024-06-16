<?php

use App\Http\Controllers\Api\v1\BookAppointmentController;
use App\Http\Controllers\Api\v1\ConfigController;
use App\Http\Controllers\Api\v1\VisitRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CallRegistersController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('applogin', [AuthController::class, 'onLogin']);

Route::get('/getVisitRegisterStatus',['middleware'=>'auth:api', ConfigController::class, 'getVisitRegisterStatus']);
Route::get('/getCallRegisterFollowUpStatus',['middleware'=>'auth:api', ConfigController::class, 'getCallRegisterFollowUpStatus']);
Route::get('/getStateList',['middleware'=>'auth:api', ConfigController::class, 'getStateList']);
Route::get('/getDistrictList/{stateName}',['middleware'=>'auth:api', ConfigController::class, 'getDistrictList']);


/*Call Register Api For Relationship manager  */
Route::group(['prefix' => 'call-register','middleware'=>'auth:api'], function () {

    Route::get('/list',[CallRegistersController::class, 'onLoadCallRegisters']);
    Route::post('/add',[CallRegistersController::class, 'storeCallRegister']);
    Route::post('/addFollowUp',[CallRegistersController::class, 'storeAddRemarks']);
    Route::get('/getDetailsCallRegister/{callRegisterId}',[CallRegistersController::class, 'getDetailsCallRegister']);

});

/*Book Appointment Api For Relationship manager  */
Route::group(['prefix' => 'book-appointment','middleware'=>'auth:api'], function () {
    Route::get('/institute-list',[BookAppointmentController::class, 'getInstituteList']);
    Route::get('/get-details-institute-information/{instId}',[BookAppointmentController::class, 'getDetailsInstituteInformation']);
    Route::get('/list',[BookAppointmentController::class, 'onLoadBookAppointments']);
    Route::post('/add',[BookAppointmentController::class, 'storeBookAppointments']);

});

/*Visit Register Api For Relationship manager  */
Route::group(['prefix' => 'visit-register','middleware'=>'auth:api'], function () {
     Route::get('/list',[VisitRegisterController::class, 'onLoadVisitRegister']);
    Route::post('/add',[VisitRegisterController::class, 'storeVisitRegister']);


});
