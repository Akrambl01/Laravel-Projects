<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use App\Services\UploadImage;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("publication.index");
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
        Publication::create($form_data);
        return to_route("publications.index")->with("success", "Votre profile a été créé avec succès");
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
        return view("publication.edit", compact("publication"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
