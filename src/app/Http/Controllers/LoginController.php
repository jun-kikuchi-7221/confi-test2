<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class LoginController extends Controller
{
    public function admin(LoginRequest $request)
    {
        $login = $request->only(['email', 'password']);

        $contacts = Contact::paginate(7);
        $categories = Category::all();
        // return view('/admin', ['login' => $login]);
        return view('admin', compact('contacts', 'categories'));
    }
}
