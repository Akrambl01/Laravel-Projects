<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use App\Services\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(["index", "show"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::latest()->paginate(9);
        return view("publication.index", compact("publications"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("publication.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationRequest $request, UploadImage $uploadImage)
    {
        $form_data = $request->validated();
        $uploadImage->upload($request, $form_data, 'image', 'publications');
        $form_data['profile_id'] = Auth::user()->id;;
        Publication::create($form_data);
        return to_route("publications.index")->with("success", "your publication has been created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        //* Authorization: to check if the user can update the publication
        Gate::authorize('update', $publication);
        // or 
        // $this->authorize('update', $publication);
        return view("publication.edit", compact("publication"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Publication $publication, UploadImage $uploadImage)
    {
        Gate::authorize('update', $publication);
        $form_data = $request->validated();
        $uploadImage->upload($request, $form_data, 'image', 'publications');
        $publication->fill($form_data)->save();
        return to_route("publications.index")->with("success", "your publication has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        Gate::authorize('delete', $publication);
        $publication->delete();
        return to_route("publications.index")->with("success", "your publication has been deleted successfully");
    }
}
