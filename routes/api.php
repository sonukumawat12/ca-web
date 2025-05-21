<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blogs', BlogController::class);
});
