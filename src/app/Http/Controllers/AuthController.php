<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    
    // 登録画面を表示
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ログイン画面を表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウト
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // ログインページにリダイレクト
    }

    

}
