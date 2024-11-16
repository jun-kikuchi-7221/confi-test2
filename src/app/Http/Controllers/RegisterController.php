<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function login()
    {
        return view('/auth/login');
    }

    public function register()
    {
        return view('register');
    }

    public function admin()
    {
        return view('admin');
    }
}
