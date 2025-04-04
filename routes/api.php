<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CreateTrackController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ListTracksController;


Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('api.login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('api.logout');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::post('/tracks', [CreateTrackController::class, 'create'])->name('create_track');
    Route::get('/tracks', [ListTracksController::class, 'list'])->name('list_tracks');
});