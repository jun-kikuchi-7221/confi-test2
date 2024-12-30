<?php

namespace App\Providers;

use App\Http\Requests\LoginRequest;
use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 認証ロジック
        
        Fortify::authenticateUsing(function (Request $request) {
             if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                 return Auth::user();
             }
             return null;
         });

        // リダイレクト設定
        Fortify::redirects('login', '/admin');

        RateLimiter::for('login', function (Request $request) {
            $ip = $request->ip(); // ユーザーのIPアドレスを取得
            return Limit::perMinute(10)->by($ip); // 1分間に10回まで許可
        });
    }


    //     Fortify::createUsersUsing(CreateNewUser::class);

    //     Fortify::registerView(function () {
    //         return view('auth.register');
    //     });
        
    //     Fortify::loginView(function () {
    //         return view('auth.login');
    //     });

    //     RateLimiter::for('login', function (Request $request) {
    //         $email = (string) $request->email;

    //         return Limit::perMinute(10)->by($email . $request->ip());
    //     });



        // Fortify::authenticateUsing(function (LoginRequest $request) {
        //         $user = \App\Models\User::where('email', $request->email)->first();

        //     if ($user && Hash::check($request->password, $user->password)) {
        //         return $user;
        //     }

        //     return null;
        // });

        // Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        // Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // RateLimiter::for('login', function (Request $request) {
        //     $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

        //     return Limit::perMinute(5)->by($throttleKey);
        // });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });
    // }
}
