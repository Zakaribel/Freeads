<?php

use App\Http\Controllers\UtilisateursController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;


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
Route::post('/register', 'App\Http\Controllers\UtilisateursController@utilisateursForm')->name('register');
Route::get('/login', 'App\Http\Controllers\UtilisateursController@login');
Route::post('/login', 'App\Http\Controllers\UtilisateursController@validateLogin')->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/emailEdit', 'App\Http\Controllers\UtilisateursController@emailEdit')->middleware('auth')->name('emailEdit');


Route::get('/createArticle', 'App\Http\Controllers\AnnoncesController@createArticle')->middleware('auth')->name('createArticle');
Route::post('/createArticle', 'App\Http\Controllers\AnnoncesController@articleForm')->middleware('auth');
Route::get('/articleEdit','App\Http\Controllers\AnnoncesController@displayArticleEdit')->name('articleEdit');
Route::post('/articleEdit','App\Http\Controllers\AnnoncesController@modifyArticle')->name('articleEdit');

Route::get('/articleDelete','App\Http\Controllers\AnnoncesController@deleteArticle')->name('articleDelete');



Route::get('/logout', 'App\Http\Controllers\UtilisateursController@logout')->name('logout');
Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\UtilisateursController@verification')->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', 'App\Http\Controllers\UtilisateursController@verificationNotif')->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/Articles', function(){

    $annonces = Annonce::all();
    return view('Articles', ['annonces' => $annonces]);
})->name('showArticles');