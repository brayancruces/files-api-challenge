<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;

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



Route::middleware('throttle:guest')->group(function () {
    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/login', [AuthController::class, 'loginUser']);
});


Route::middleware('auth:sanctum', 'throttle:logged')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('files', [FileController::class, 'index']);
    Route::get('files/{id}', [FileController::class, 'show']);
    Route::delete('files/{id}', [FileController::class, 'destroy']);
    Route::post('files', [FileController::class, 'create']);
    Route::post('files/bulk/', [FileController::class, 'bulkUpload']);
   
});

Route::fallback(function (){
    abort(404, 'API no encontrado');
});


