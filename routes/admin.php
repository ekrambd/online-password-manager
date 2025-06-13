<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;

Route::group(['middleware' => 'prevent-back-history'],function(){
//categories
 Route::resource('categories', CategoryController::class);
//users
 Route::resource('users', UserController::class);
//groups
 Route::resource('groups', GroupController::class);
});
