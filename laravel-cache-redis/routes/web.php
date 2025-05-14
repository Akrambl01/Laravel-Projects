<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', [UsersController::class, "index"]);
Route::get('/clear-users-cache', [UsersController::class, "clearCache"]);
