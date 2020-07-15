<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Auth::routes(['register' => false, 'login' => false, 'confirm' => false, 'email' => false, 'request' => false, 'update' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');
//login with Google
Route::get('/login/google', 'Auth\LoginController@redirectToProvider');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');
//Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');