<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', function () {
     Auth::logout();
     return redirect('/login');
})->name('logout');


Route::get('/contents', [ContactController::class, 'index'])->name('contacts.index');

Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::post('/contacts/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::post('/thanks', [ContactController::class, 'thanks']);
Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
// });

// Route::get('/login', [AuthController::class, 'index']);
// ユーザー登録画面
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// ログイン画面
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

Route::get('/admin/export', [ExportController::class, 'export'])->name('admin.export');