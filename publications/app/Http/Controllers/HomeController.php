<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $users = [["id" => 1, "nom" => "Akram", "metier" => "Developer"], ["id" => 2, "nom" => "Ibnelyazyd", "metier" => "Designer"], ["id" => 3, "nom" => "abdo", "metier" => "Manager"]];
        return view("home", compact("users"));
    }
}
