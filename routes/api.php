<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/urls', [UrlController::class, 'index']);
Route::get('/urls/{shortCode}', [UrlController::class, 'single_url']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/urls', [UrlController::class, 'add']);
    Route::put('/urls/{id}', [UrlController::class, 'update']);
    Route::delete('/urls/{id}', [UrlController::class, 'delete']);
});
