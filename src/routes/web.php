<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;

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

/*Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/thanks', [ContactController::class, 'thanks']);
Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/login', [RegisterController::class, 'login']);
Route::post('/register', [RegisterController::class, 'login']);
Route::get('/register', [RegisterController::class, 'register']);
Route::post('/user', [RegisterController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

Route::get('/admin/export', [ExportController::class, 'export'])->name('admin.export');