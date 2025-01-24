<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::middleware('auth:basic')->group(function () {
    Route::apiResource('artists', ArtistApiController::class)->middleware(['auth.basic']);
//});