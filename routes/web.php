<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('dashboard', function () {
    if(Auth::check() && Auth::user()->role === 1) {
        return auth()->user()->createToken('auth_token', ['admin'])->plainTextToken;
    }
    return redirect("/");
})->middleware('auth');

Route::get('clear/token', function () {
    if(Auth::check() && Auth::user()->role === 1) {
        Auth::user()->tokens()->delete();
    }
    return 'Token Cleared';
})->middleware('auth');

Auth::routes();

Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('restrictothers')->name('register');
Route::post('register', [RegisterController::class, 'register'])
    ->middleware('restrictothers');

Route::get('/home', [HomeController::class, 'index'])->name('home');
