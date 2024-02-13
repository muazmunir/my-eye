<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DeviceController;
use App\Http\Controllers\DeviceDataController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [AuthController::class, 'reset']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/devices', [DeviceController::class, 'index']);
    Route::post('/devices', [DeviceController::class, 'register']);

    Route::post('/devices/{id}/current-location', [DeviceDataController::class, 'postCurrentLocation']);
    Route::get('/devices/{id}/location-history', [DeviceDataController::class, 'getLocationHistory']);
    // Route::get('/devices/{id}/geofencing-alerts', [DeviceDataController::class, 'getGeofencingAlerts']);
    Route::post('/devices/{id}/messages-logs', [DeviceDataController::class, 'storeMessageLogs']);
    Route::get('/devices/{id}/messages-logs', [DeviceDataController::class, 'getMessagesLogs']);
    Route::post('/devices/{id}/call-logs', [DeviceDataController::class, 'storeCallLogs']);
    Route::get('/devices/{id}/call-logs', [DeviceDataController::class, 'getCallLogs']);
    Route::post('/devices/{id}/gallery-entries', [DeviceDataController::class, 'storeGalleryEntry']);
    Route::get('/devices/{id}/gallery-entries', [DeviceDataController::class, 'fetchGalleryEntries']);
});
