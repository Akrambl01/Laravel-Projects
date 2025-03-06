<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

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

require __DIR__ . '/auth.php';


Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');



// redirection
Route::redirect('/here', '/there', 301);
Route::get('/there', function () {
    return 'You are here!';
});


// injection de dépendance
Route::get('/method', function (Request $request) {
    return 'HTTP Method: ' . $request->method();
});

Route::view('/welcome', 'welcome');

Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});

// groupement de routes
Route::prefix('admin')->middleware('auth')->group(function () {
    // Définition des routes d'administration
});

//? response:
Route::get('/hello', function () {
    return 'bonjour le monde';
});
Route::get('/numbers', function () {
    return [1, 2, 3];
});

Route::get('/user/{user}', function (User $user) {
    return $user;
});

Route::get('/cookie', function () {
    return response('Bonjour le Monde')->cookie('name', 'value', 60);
});

// Route pour la redirection vers une page de tableau de bord
Route::get('/dashboard', function () {
    return redirect('dashboard/home');
});
// Route pour la redirection vers l'emplacement précédent
Route::post('/submit-form', function () {
    // Logique de validation...
    return back()->withInput();
});
