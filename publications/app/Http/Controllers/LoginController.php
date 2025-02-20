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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route("homepage")->with("success", "You are logged in".$login.".");
        } else {
            return back()->withErrors([
                "login" => "Email or password is incorrect",
            ])->onlyInput('login');
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
