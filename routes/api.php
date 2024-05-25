<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/appointments',[MeetingController::class,"index"]);
Route::post('/appointments/store',[MeetingController::class,"store"]);
Route::get('/appointments/unavailable',[MeetingController::class,"unavailableDates"]);

Route::post('/login',[UserController::class,"login"]);

