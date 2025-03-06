<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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



//? Création d'une vue
// php artisan make:view greeting
// Route pour retourner la vue
Route::get('/greeting', function () {
 return view('greeting', ['name' => 'Akram']);
});

Route::resource('admin', AdminController::class);

//? Précompiler toutes les vues utilisées par l'application
// php artisan view:cache
//? Vider le cache des vues
// php artisan view:clear