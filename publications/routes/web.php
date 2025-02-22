<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
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
Route::resource("publications", PublicationController::class);
// when we use the resource method we get the following routes
// GET /profiles => index : to get all profiles
// GET /profiles/create => create : to show the form to create a profile
// POST /profiles => store : to store the profile in the database
// GET /profiles/{id} => show : to show a specific profile
// GET /profiles/{id}/edit => edit : to show the form to edit a profile
// PUT/PATCH /profiles/{id} => update : to update the profile in the database
// DELETE /profiles/{id} => destroy : to delete the profile from the database


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

// set cookies
Route::get("/cookie/set/{cookie?}", function($cookie = "default cookie"){
    $response = new Response("Cookie Set ".$cookie , 200);
    // to set a cookie we use the cookie method and pass the name of the cookie and the value and the time to expire in minutes
    $cookieObject = cookie("username", $cookie, 5);
    // to set a cookie forever 
    // $cookieObject = cookie()->forever("username", $cookie);
    return $response->withCookie($cookieObject);
});

// get cookies
Route::get("/cookie/get", function(Request $request){
    // to get a cookie we use the cookie method and pass the name of the cookie
    return $request->cookie("username", "default value");
});

// delete cookies
Route::get("/cookie/delete", function(){
    $response = new Response("Cookie Deleted", 200);
    // to delete a cookie we use the cookie method and pass the name of the cookie and set the time to expire to -1
    // $cookieObject = cookie("username", "", -1);
    // or 
    $cookieObject = cookie()->forget("username");
    return $response->withCookie($cookieObject);
});

// * headers
// headers are used to send additional information with the request or the response , 
// this information can be used to authenticate the user or to send the content type of the response , content type is used to tell the browser how to render the response
Route::get("/headers", function(Request $request){
    // to get a header we use the header method and pass the name of and we can pass a default value if the header is not found
    dd($request->header("Content-Type", "default value"));

    // to get all headers
    // return $request->headers->all();

    // to send a header we use the header method and pass the name of the header and the value
    // return response(["data"=>[1,2,3,4,5,6,7,7,8,90,0]])->withHeaders(["Content-Type"=>"application/json", "X-akram-Token"=>"b4jdh7ibve6rhf"]);
});

//* request
Route::get("/request", function(Request $request){
    dd($request->url(), $request->fullUrl(), 
    $request->path(), $request->is("request"),
    $request->query(), $request->host(), 
    $request->method(), $request->isMethod("get"),
    $request->ip(), $request->userAgent(), 
    $request->server(), $request->getClientIp());
});
// user agent is used to get the browser information of the user to know the browser and the version and the operating system and the device type and the engine used to render the page and 
// the user agent is used to render the page in a specific way to be compatible with the browser and the device and the operating system