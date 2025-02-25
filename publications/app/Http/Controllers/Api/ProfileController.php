<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private const CACHE_KEY = "profiles_api";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //? query builder
        //* work with query builder to customize the query
        // ex: get just the name, email, and bio columns from the profiles table
        // dd(DB::table("profiles")->where("id", 204)->select("name", "email", "bio")->first()); // use first to get the first row that matches the query bc get returns a collection
        // get all emails from the profiles table
        // dd(DB::table("profiles")->pluck("email"));
        //* we can work also with aggregate functions like : count, sum, avg, min, max
        // dd(DB::table("profiles")->max("created_at")); // get the max value of the created_at column
        // dd(DB::table("profiles")->where("id", ">" ,150)->get()) // get all the profiles that have an id greater than 150;
        //* check existance of a record
        // dd(DB::table("profiles")->where("id", 204)->exists()); // return true if there is a record with id = 204
        //* join tables
        // ex: get the name of the profile and the title of the publication that the profile has
        // dd(DB::table("profiles")->join("publications", "profiles.id", "=", "publications.profile_id")->get());

        //* debugging queries
        // ex: get the sql query that is executed
        // dd(DB::table("profiles")->orderBy("id", "desc")->toSql());
        // or 
        // dd(DB::table("profiles")->where("id", 204)->dd()); // to get the result and stop the execution of the code

        $profiles = Cache::remember(self::CACHE_KEY, 10000, function(){
            return ProfileResource::collection(Profile::all());
        });

        return $profiles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->all();
        $formFields["password"] = Hash::make($request->password);
        $profile = Profile::create($formFields);

        // Delete cache
        Cache::forget(self::CACHE_KEY);
        // Update cache
        Cache::remember(self::CACHE_KEY, 10000, function(){
            return ProfileResource::collection(Profile::all());
        });

        return new ProfileResource($profile);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $formFields = $request->all();
        $profile->fill($formFields)->save();
        $formFields["password"] = Hash::make($formFields["password"]);

        // Delete cache
        Cache::forget(self::CACHE_KEY);
        // Update cache
        Cache::remember(self::CACHE_KEY, 10000, function(){
            return ProfileResource::collection(Profile::all());
        });

        return new ProfileResource($profile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        // Delete cache
        Cache::forget(self::CACHE_KEY);
        // Update cache
        Cache::remember(self::CACHE_KEY, 10000, function(){
            return ProfileResource::collection(Profile::all());
        });

        return response()->json(["message" => "profile deleted successfully", "id" => $profile->id, "errors" => []]);
    }
}
