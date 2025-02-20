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

// crate a route to the welcome page and pass some data to it (variables : do, nom, prenom, age, ville, or data in url {wildcard})

/*
Route::get("/welcome/{nom}", function ($nom) {
    $do = "Learn Laravel";
    // $nom = "Akram";
    $prenom = "Ibnelyazyd";
    $age = 21;
    $ville = "Casablanca";  
    // -----Method 1 : Using the compact() function----
    // return view("welcome", compact("do", "nom", "prenom", "age", "ville"));

    // -----Method 2 : Using the array ----
    return view("welcome", ["do" => $do, "nom" => $nom, "prenom" => $prenom, "age" => $age, "ville" => $ville]);
});

*/

// the same but in easier way
/* when we need multiple data in url(wildcard) we can use request object
request object is an instance of the Request class that is automatically injected into the route's callback function by Laravel when the route is executed. */ 

Route::get("/welcome/{nom}/{prenom}", function (Request $request) {
    $do = "Learn Laravel";
    // $nom = "Akram";
    // $prenom = "Ibnelyazyd";
    $age = 21;
    $ville = "Casablanca";  
    return view("welcome", ["do" => $do, "nom" => $request->nom, "prenom" => $request->prenom, "age" => $age, "ville" => $ville]);
});

// Route::get("/", function (Request $request) {
//     return "Hello World";
// });

// to make route communicate with controller we can use the controller method in the route class and pass the controller name and the method name as a string in array
// 1- create a controller using the command line : php artisan make:controller ControllerName
// 2- create a method in the controller that will return the view or the data that we want to display in the view 
// 3- create a route that will communicate with the controller and pass the controller name and the method name as a string in array  
// 4- in the controller method we can return the view or the data that we want to display in the view 

// syntax: Route::get("url", [ControllerName::class, "methodName"]);

Route::get("/", [HomeController::class, "index"])->name("homepage");

// create route group to group the routes that have the same prefix (profiles) and name (profiles.) to avoid repeating the prefix and the name in each route
Route::name("profiles.")->prefix("profiles")->group(function(){
    // group also routes for controller(ProfileController) to avoid repeating the controller name in each route
    Route::controller(ProfileController::class)->group(function(){
        Route::get("/", [ProfileController::class, "index"])->name("index");
        // by default the route model binding is based on the id column in the profiles table this {profile} is the id of the profile, if we want to use another column we have to specify it like this {profile:email}
        Route::get("/profile/{profile}", "show")->where("profile", "\d+")->name("show");
        Route::get("/create", "create")->name("create");
        Route::post("", "store")->name("store");
        Route::delete("/{profile}", "destroy")->name("destroy");
        Route::get("/{profile}/edit", "edit")->name("edit");
        Route::put("/{profile}", "update")->name("update");
    });
});



Route::get("/settings", [InfoController::class, "index"])->name("settings.index");

Route::get("/login", [LoginController::class, "show"])->name("login.show");
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::get("/logout", [LoginController::class, "logout"])->name("login.logout");



