<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('device', [DeviceController::class, 'index']);
    Route::post('device', [DeviceController::class, 'store']);
    Route::post('send-message', [MessageController::class, 'send']);
});
Route::post('/device/update-status', [DeviceController::class, 'update']);
