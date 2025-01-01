<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class LoginController extends Controller
{
    public function admin(Request $request)
    {
        $login = $request->only(['email', 'password']);

        $contacts = Contact::paginate(7);
        $categories = Category::all();

        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました。');
    }

    public function redirectTo()
    {
        return '/admin';
    }
}
