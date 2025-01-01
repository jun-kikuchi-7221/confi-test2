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

    // ログイン処理
    // public function login(LoginRequest $request)
    // {
        // バリデーション済みのデータを使ってログイン処理
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials, $request->has('remember'))) {
            // return redirect()->intended('/dashboard'); // 管理画面へリダイレクト
            // $contacts = Contact::paginate(7);
            // $categories = Category::all();

            // ログイン成功
            // return redirect()->route('admin')->with('contacts', 'categories', 'request');
            // return redirect()->route('admin'); // 管理画面へリダイレクト

        // }

        // ログイン失敗
        // return back()->withErrors([
        //     'email' => 'メールアドレスまたはパスワードが正しくありません。',
        // ]);

        // return back()->withErrors([
        //     'email' => '認証情報が正しくありません。',
        // ])->withInput();
    // }

}
