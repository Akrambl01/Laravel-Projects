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


// optional parameter 
Route::get("/page/{id?}",function($id = null){
    if(empty($id)){
        return "id is unknown";
    }
    return "id is ". $id;
});

Route::get("/route",function(){
    // we use this methods to get the current route informations
    dd(Route::current()); // return the current route object 
    dd(Route::currentRouteName()); // return the current route name ex: route for this case
    dd(Route::currentRouteAction()); // return the current route action ex: index
})->name("route");

// to redirect to another web site
Route::get("/google",function(){
    return redirect()->away("https://www.google.com");
});

// to cache routes we use this command php artisan route:cache : for performance reasons, to laravel not to read the routes file every time 
// to clear the cache we use this command php artisan route:clear : to disable the cache 
// to list all routes we use this command php artisan route:list
// to list all routes with their middleware we use this command php artisan route:list --show

