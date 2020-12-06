<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'AuthController@login');

// Public Resources
Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/{specialty}/doctors', 'SpecialtyController@doctors');
Route::get('/schedule/hours', 'ScheduleController@hours');

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::get('/user', 'UserController@show');
    Route::post('/logout', 'AuthController@logout');

    // Post Appointment
});