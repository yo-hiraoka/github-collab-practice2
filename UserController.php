<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::pagenate(20);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validatted = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect('/users');
    }
}
