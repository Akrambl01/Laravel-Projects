<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.index',  compact('users'));
    }

    public function unique()
    {
        $users = DB::table('users')->select('name', 'email')->distinct()->get();
        return view('users.unique', compact('users'));
    }

    public function contacts()
    {
        $users = DB::table('users')
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();
        return view('users.contacts', compact('users'));
    }

    public function filterUsers()
    {
        $users = DB::table('users')
        ->where('votes', '>', 100)
        ->orWhere('name', 'John')
        ->get();
        return view('users.filtered', ['users' => $users]);
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
