<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

 //Get Theses
 Route::get('getTheses',[App\Http\Controllers\ThesisController::class, 'getTheses']);

 //Get Tags
 Route::get('getTags',[App\Http\Controllers\ThesisController::class, 'getTags']);

 //Get Thesis detail
 Route::get('get_thesis/{id}',[App\Http\Controllers\ThesisController::class, 'get_thesis']);

 //Save Theses
 Route::post('saveTheses',[App\Http\Controllers\ThesisController::class, 'saveTheses']);

 //Update Theses
 Route::post('updateTheses/{id}',[App\Http\Controllers\ThesisController::class, 'updateTheses']);

 //Save Theses
 Route::delete('deleteThesis/{id}',[App\Http\Controllers\ThesisController::class, 'deleteThesis']);
