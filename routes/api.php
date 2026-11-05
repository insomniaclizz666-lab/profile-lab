<?php

// routes/api.php — API Routes
// Semua route di sini otomatis mendapat prefix "/api"
// dan middleware "api" (throttle, no session/CSRF).

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
