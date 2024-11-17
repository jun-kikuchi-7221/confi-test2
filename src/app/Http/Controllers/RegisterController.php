<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function login()
    {
        return view('/auth/login');
    }

    public function register()
    {
        return view('/auth/register');
    }

    public function store(Request $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        User::create($register);
        return view('/auth/login');
    }

    public function admin()
    {
        return view('admin');
    }
}
