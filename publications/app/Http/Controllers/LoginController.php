<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show(){
        return view("login.show");
    }

    public function login(Request $request){
        $login = $request->login;
        $password = $request->password;
        $credentials = ["email" => $login, "password" => $password];
        // attempt is a method that takes an array of credentials and check if the user exists in the database
        // if the user exists it will log him in and return true
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route("homepage")->with("success", "You are logged in".$login.".");
        } else {
            return back()->withErrors([
                "login" => "Email or password is incorrect",
            ])->onlyInput('login'); // we use onlyInput to keep the email in the input field after the redirection
        }
      
    }

    public function logout(){
        // to delete the session
        Session::flush();
        // to logout the user
        Auth::logout();

        return to_route('login')->with("success", "You are logged out.");
    }
}
