<?php

use App\Http\Controllers\UtilisateursController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
});



Route::get('/register', 'App\Http\Controllers\UtilisateursController@createUtilisateursForm');
Route::post('register', 'App\Http\Controllers\UtilisateursController@utilisateursForm')->name('register');
Route::get('/login', 'App\Http\Controllers\UtilisateursController@login');
Route::post('login', 'App\Http\Controllers\UtilisateursController@validateLogin')->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('home', 'App\Http\Controllers\UtilisateursController@emailEdit')->name('emailEdit');

Route::get('/logout', 'App\Http\Controllers\UtilisateursController@logout')->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');
