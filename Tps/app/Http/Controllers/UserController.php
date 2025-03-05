<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::all();
        return $users;
    }

    public function show(User $user)
    {
        return $user;
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Récupérer des informations sur la requête 
        $path = $request->path();
        $url = $request->url();
        $full = $request->fullUrl();
        $method = $request->method();
        $input = $request->input();
        $query = $request->query();
        $header = $request->userAgent();
        $file = $request->file('image');
        $date = $request->date("Y-m-d");
        $cookieset = $request->cookie('name', 'value');
        $cookieget = $request->cookie('name');
        $cookie = $request->cookie();

        // Exemples d'utilisation de méthodes pour récupérer les données d'entrée
        $name = $request->input('name');
        $allInput = $request->all();
        $queryParam = $request->query('param');
        $oldInput = $request->old('name');
        dd($path, $url, $full, $method, $input, $query, $header, $file, $date, $cookieset, $cookieget, $cookie, $name, $allInput, $queryParam, $oldInput);
        return redirect('/users');
    }

    public function update($id)
    {
        return 'update user (update) ' . $id;
    }

    public function destroy($id)
    {
        return 'delete user (destroy) ' . $id;
    }
}
