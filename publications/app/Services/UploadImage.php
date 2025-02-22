<?php 
namespace App\Services;
use Illuminate\Http\Request;

class UploadImage
{
    public function upload(Request $request, array &$formFields, string $fieldName, string $directory = 'uploads', string $disk = 'public')
    {
        unset($formFields[$fieldName]);
        if ($request->hasFile($fieldName)) {
            $formFields[$fieldName] = $request->file($fieldName)->store($directory, $disk);
        }
    }
}

// how to use this class in a controller
// <?php
//
// namespace App\Http\Controllers;  
//
// use App\Http\Requests\PublicationRequest;
// use App\Models\Publication;
// use App\Services\UploadImage;
// use Illuminate\Http\Request;
//
// class Publication
// {
//     public function store(PublicationRequest $request, UploadImage $uploadImage)
//     {
//         $form_data = $request->validated();
//         $uploadImage->upload($request, $form_data, 'image', 'images');
//         Publication::create($form_data);
//         return redirect()->route('publications.index');
//     }
// }
// ?>