<?php

use App\Http\Controllers\ThesisController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\AuthController;
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

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/theses', [ThesisController::class, 'index']);
Route::get('/theses/{id}', [ThesisController::class, 'show']);
Route::get('/theses/search/{titel}', [ThesisController::class, 'search']);

Route::get('/tags', [TagsController::class, 'index']);
Route::get('/tags/{id}', [TagsController::class, 'show']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/theses', [ThesisController::class, 'store']);
    Route::put('/theses/{id}', [ThesisController::class, 'update']);
    Route::delete('/theses/{id}', [ThesisController::class, 'destroy']); 
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/tags', [TagsController::class, 'store']);
    Route::put('/tags/{id}', [TagsController::class, 'update']);
    Route::delete('/tags/{id}', [TagsController::class, 'destroy']); 
});





//Protected routes
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

 //Get Theses
 //Route::get('getTheses',[App\Http\Controllers\ThesisController::class, 'getTheses']);
 
 //Get Tags
 //Route::get('getTags',[App\Http\Controllers\ThesisController::class, 'getTags']);

 //Get Thesis detail
 //Route::get('get_thesis/{id}',[App\Http\Controllers\ThesisController::class, 'get_thesis']);

 //Save Theses
 //Route::post('saveTheses',[App\Http\Controllers\ThesisController::class, 'saveTheses']);
 

 //Update Theses
 //Route::post('updateTheses/{id}',[App\Http\Controllers\ThesisController::class, 'updateTheses']);

 //Save Theses
 //Route::delete('deleteThesis/{id}',[App\Http\Controllers\ThesisController::class, 'deleteThesis']);
