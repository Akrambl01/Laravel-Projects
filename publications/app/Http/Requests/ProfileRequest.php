<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // we return true because we want to authorize all users to make this request without any condition like authentication
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // the name field is required and must be a string and between 3 and 20 characters
            "name" => "required|string|between:3,20",
            // the email field is required and must be a string and a valid email and unique in the profiles table (unique:profiles) 
            "email" => "required|string|email",
            // the password field is required and must be a string and at least 8 characters and confirmed
            "password" => "required|string|min:8|confirmed",
            // "password_confirmation" => "required|confirmed",
            "bio" => "required|string",
            // the image field is required and must be an image and jpeg, png, jpg, svg and max size is 8 Mb
            "image" => "image|mimes:jpeg,png,jpg,svg|max:8192",
        ];
    }
}
