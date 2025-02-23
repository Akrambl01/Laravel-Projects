<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $profiles = Profile::all();
        // return response()->json($profiles);
        // or 
        // return Profile::all();
        // to get also the deleted profiles
        // return Profile::withTrashed()->get();

        // when work resource class
        return ProfileResource::collection(Profile::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->all();
        $formFields["password"] = Hash::make($request->password);
        $profile = Profile::create($formFields);
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
        
        return new ProfileResource($profile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(["message" => "profile deleted successfully", "id" => $profile->id, "errors" => []]);
    }
}
