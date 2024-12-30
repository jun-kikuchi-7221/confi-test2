<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function login(Request $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        return view('/auth/login', ['register' => $register]);
    }

    public function register()
    {
        return view('/auth/register');
    }

    public function store(RegisterRequest $request)
    {   
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        // $register = $request->only(['name', 'email', 'password']);
        User::create($data);
        return redirect()->route('login');
    }

    
}
