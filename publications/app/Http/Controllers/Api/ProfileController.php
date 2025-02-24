<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private const CACHE_KEY = "profiles_api";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
