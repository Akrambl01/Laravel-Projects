<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

// Etape 1 : : Routage de base
Route::get('/greeting', function () {
    return 'Hello World';
});

// Step 2: Default Route Files
Route::get('/users', [UserController::class, 'index']);

// Étape 3 : Méthodes de Routage Disponibles
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
// Route::get('/users/{user}', [UserController::class, 'show']);
// Route::put('/users/{user}', [UserController::class, 'update']);
// Route::delete('/users/{user}', [UserController::class, 'destroy']);
// Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');


// Étape 4 : Injection de Dépendance
Route::get('/method', function (Request $request) {
    return 'HTTP Method: ' . $request->method();
});

// Étape 6 : Routes de Redirection
Route::redirect('/here', '/there', 301);
Route::get('/there', function () {
    return 'You are here!';
}); 

// Étape 7 : Routes de Vue
Route::view('/welcome', 'welcome');

// Étape 8 : Paramètres de Route
Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});

// Étape 9 : Routes Nommées
Route::get('/user/profile', function () {
    // Logique de la route
})->name('profile');

// Étape 10 : Groupe de Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    // Définition des routes d'administration 
});

// Étape 11 : Liaison de Modèle de Route
Route::get('/users/{user}', function (User $user) {
    return $user->name;
});

// Étape 12 : Mise en Cache des Routes
// php artisan route:cache : pour mettre en cache les routes
// php artisan route:clear : pour effacer le cache des routes