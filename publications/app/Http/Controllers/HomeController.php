<?php

namespace App\Http\Controllers;

use App\Mail\ProfileMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request){
        //? session
        // to store data in the session
        // $request->session()->put("count", 3);
        // to get data from the session
        // $count = $request->session()->get("count");
        // to delete data from the session (delete permanently)
        // $request->session()->forget("count");
        // to delete data from the session but keep the session (soft delete)
        // $request->session()->delete("count");
        // to delete all data from the session
        // $request->session()->flush();
        // to check if a key exists in the session
        // $request->session()->has("count");
        // to get all the data from the session
        // $request->session()->all();
        
        // to increment the value of the count key in the session, by default the increment value is 1
        $count = $request->session()->increment("count", 1);

        // to add value to session array 
        // $request->session()->push("user.teams", "developers");
        // to store session and delete once it is read
        // $request->session()->flach();

        // $mailer = new ProfileMail("akram", "akram@gmail");
        // Mail::to("akramibnelyazid@gmail.com")->send($mailer);

        return view("home", ["count" => $count]);

    }
}
