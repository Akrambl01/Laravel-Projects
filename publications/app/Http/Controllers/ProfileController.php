<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct(){
        // to protect the routes that i want to protect
        // $this->middleware("auth")->only(["create", "store", "edit", "update", "destroy"]);
        // to protect all routes except the index and show routes
        // $this->middleware("auth")->except(["index", "show"]);
        // to protect all the routes in the controller
        $this->middleware("auth");
    }

    public function index(){
    
        // to get all the data from the profiles table
        // $profiles = Profile::all();

        // to get the data from the profiles table with pagination (9 profiles per page)
        // $profiles = Profile::paginate(9);

        $profiles = Cache::remember("profiles", 10, function(){
            return Profile::paginate(9);
        });
        return view("profile.index", compact("profiles"));

        //* to delete the cache
        // Cache::forget("profiles");
        //* to get the cache and delete form DB it in the same time
        // $profiles = Cache::pull("profiles");
    }

    public function show(Profile $profile){
        /* if work with route model binding i don't need to get the data from the profiles table with the id = $id
        because laravel will do this for me and store the data in the $profile variable 
        */

        /* use this if i work with request object
        -to get the id from the request and convert it to an integer 
        $id = (int)$request->id;
        -to get the data from the profiles table with the id = $id
        $profile = Profile::findOrFail($id);
        */

        // if i work with find() not findOrFail() i have to check if the profile is null or not :
        // if(!$profile){
        //    return abort(404);
        // }

        $cachePrefix = "profile_".$profile->id;
        //* method 1 to store the data in the cache
        /*
        / has method to check if the cache exists or not
        if(Cache::has($cachePrefix)){
            / get the data from the cache
            $profile = Cache::get($cachePrefix);
        }else{
            /put , to store the data in the cache with the key $cachePrefix and the value $profile and the expiration time is 5 minutes
        Cache::put($cachePrefix, $profile, 5);
        / or forever , to store the data in the cache forever
        / Cache::forever($cachePrefix, $profile);
        }
       */

        //* method 2 to store the data in the cache
        // instead of using the has() to check and put() to store the data in the cache we can use the remember() method 
        $profile = Cache::remember($cachePrefix, 5, function() use($profile){
            return $profile;
        });

        return view("profile.show", compact("profile"));
    }

    public function create(){
        return view("profile.create");
    }

    public function store(ProfileRequest $request){
        // method 1 : get the data from the request and store it in variables
        // $name = $request->name;
        // $email = $request->email;
        // $password = $request->password;
        // $bio = $request->bio;
        
        //* validation
        /*
        use this if not work with ProfileRequest class
        - validate the data before storing it in the database 
        $formFields =  $request->validate([
            "name" => "required|string|between:3,20",
            "email" => "required|string|email|unique:profiles",
            "password" => "required|string|min:8|confirmed",
            "password_confirmation" => "required|confirmed",
            "bio" => "required|string",
        ]);
        */

        // if i work with ProfileRequest class 
        $formFields = $request->validated();

        //* insertion
        // method 1 continued : insert the data in the profiles table 
        // the rule to use this method is to make the fields fillable in the model 
        // Profile::create([
        //     "name" => $name,
        //     "email" => $email,
        //     "password" => $password,
        //     "bio" => $bio,
        // ]);

        // method 2 : get the data from the request and store it in the database
        // the rule to use this method is the name of the fields in the form must be the same as the columns in the database, and make the fields fillable in the model 
        // Profile::create($request->post());

        //* hash
        // $formFields["password"] = bcrypt($formFields["password"]);
        // or
        $formFields["password"] = Hash::make($formFields["password"]);

        // to store the image in the public folder and store the path in the database
        $this->uploadImage($request, $formFields);

        //* insertion after hashing the password:
        Profile::create($formFields);

        //* redirections :
        // to redirect the user to the profiles page after storing the data in the database
        // with() method is used to pass a message to the next page (flash message) the value of the message is stored in the session and will be deleted after the next request
        return redirect()->route("profiles.index")->with("success", "Votre profile a été créé avec succès");

        //* redirections methods :
        // redirect("url") :  to redirect the user to a specific page
        // redirect()->route("routeName") : to redirect the user to a specific route or to_root(route("routeName"))
        // redirect()->back() : to redirect the user to the previous page
        // redirect()->action("ControllerName@methodName") : to redirect the user to a specific controller method


        // the best practice to use method 1 because it's more secure and more readable
        // bc we choose the fields that we want to insert in the database
        // and we can add some conditions to the fields before inserting them in the database
        // and the method 2 is not secure bc we can insert fields that we don't want to insert in the database example : field created by the user, and the can know the name of fields that we have in the database 
    }

    public function destroy(Profile $profile){
        // to delete the data from the profiles table with the id = $id
        $profile->delete();

        return to_route("profiles.index")->with("success", "Votre profile a été supprimé avec succès");
    }

    public function edit(Profile $profile){
        return view("profile.edit", compact("profile"));
    }

    public function update(ProfileRequest $request, Profile $profile){
        $formFields = $request->validated();
       
        $this->uploadImage($request, $formFields);
        
        $profile->fill($formFields)->save();
        $formFields["password"] = Hash::make($formFields["password"]);
        return to_route("profiles.show", $profile->id)->with("success", "Votre profile a été modifié avec succès");
    }

    // & for passing by reference that means the changes that we make in the function will be applied to the variable that we pass to the function
    public function uploadImage(ProfileRequest $request, array &$formFields){
        unset($formFields["image"]);
        if($request->hasFile("image")){
            $formFields["image"] = $request->file("image")->store("profiles", "public");
        } 
    }
}
