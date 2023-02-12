<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use App\Http\Controllers\teacherController;

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


Route::post('insert_student', [studentController::class, 'insert_student']);
Route::post('insert_teacher', [teacherController::class, 'insert_teacher']);
Route::post('login_teacher', [teacherController::class, 'login_teacher']);
Route::post('login_student', [studentController::class, 'login_student']);
Route::post('logout_teacher', [teacherController::class, 'logout_teacher']);
Route::post('logout_student', [studentController::class, 'logout_student']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  
});
