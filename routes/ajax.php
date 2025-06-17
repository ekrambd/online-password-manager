<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

//ajax requests
Route::post('category-status-update', [AjaxController::class, 'categoryStatusUpdate']);
Route::post('user-status-update', [AjaxController::class, 'userStatusUpdate']);
Route::post('group-status-update', [AjaxController::class, 'groupStatusUpdate']);
Route::post('password-status-update', [AjaxController::class, 'passwordStatusUpdate']);