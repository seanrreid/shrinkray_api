<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/{short_url}', function ($short_url) {
    return UrlController::sendit($short_url);
})->name('redirect.short_url');


require __DIR__.'/auth.php';
