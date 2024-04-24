<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoController;

Route::get('/photos', [PhotoController::class, 'index'])->name('api.photos');
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('api.photo');
