<?php

// to use the HomeController class
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
// to use the Route class
use Illuminate\Support\Facades\Route;
// to use the Request class
use Illuminate\Http\Request;


Route::get("/welcome/{nom}/{prenom}", function (Request $request) {
    $do = "Learn Laravel";
    $age = 21;
    $ville = "Casablanca";  
    return view("welcome", ["do" => $do, "nom" => $request->nom, "prenom" => $request->prenom, "age" => $age, "ville" => $ville]);
});
Route::get("/", [HomeController::class, "index"])->name("homepage");


Route::resource("profiles", ProfileController::class);

Route::get("/settings", [InfoController::class, "index"])->name("settings.index");

Route::middleware("guest")->group(function () {
    Route::get("/login", [LoginController::class, "show"])->name("login.show");
    Route::post("/login", [LoginController::class, "login"])->name("login");
});

Route::get("/logout", [LoginController::class, "logout"])->name("login.logout")->middleware("auth");