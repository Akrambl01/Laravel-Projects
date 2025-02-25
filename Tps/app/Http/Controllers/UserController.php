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

    public function store()
    {
        return 'create user (store)';
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
