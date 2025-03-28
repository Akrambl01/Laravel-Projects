<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/articles', ArticleController::class)->middleware('auth');

Route::get('/users', [UserController::class, "index"])->name('users.index');
Route::get('/users/unique', [UserController::class, "index"])->name('users.unique');
Route::get('/users/unique', [UserController::class, "index"])->name('users.unique');
Route::get('/users/contacts', [UserController::class, "contacts"])->name('users.contacts');
Route::get('/users/filter', [UserController::class, "filterUsers"])->name('users.filter');


   