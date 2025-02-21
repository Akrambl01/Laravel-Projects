<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

//* redirect to another web site
Route::get("/google",function(){
    return redirect()->away("https://www.google.com");
});

// to cache routes we use this command php artisan route:cache : for performance reasons, to laravel not to read the routes file every time 
// to clear the cache we use this command php artisan route:clear : to disable the cache 
// to list all routes we use this command php artisan route:list
// to list all routes with their middleware we use this command php artisan route:list --show

Route::view("/form","form");
Route::post("/form",function(Request $request){
    //* use the input method to get the value of the input field , instead of using the request object bc it's more readable and performant and have more features and methods
    // dd($request->input("input_field", "default value"));
    // dd($request->input("date", "2004/12/12"));
    // dd($request->input());
    $request->mergeIfMissing(["date"=>date("Y/m/d")]);
    dd($request->input("date"));
})->name("form");


//* Response 
// we use Response to return a response with a specific status code and headers and download files
Route::get("/response",function(){
    $response = new Response("Hello World", 200);
    // return $response->header("Content-Type","text/plain");
    // return  response("Hello World", 200)->header("Content-Type","text/plain");
    // to download a file
    // return response()->download(public_path("robots.txt"));
    // to return a file with a specific name and headers and inline to show the file in the browser instead of downloading it 
    // return response()->download(public_path("storage/profiles/user.png","name.png",[""], "inline"));
    // to return a file
    return response()->file(public_path("storage/profiles/user.png"));
    //*diff between download and file is that file return the file content (read file) in the browser and download download the file

});

