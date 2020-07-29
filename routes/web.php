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

//login with Google
Route::get('/login/google', 'Auth\LoginController@redirectToProvider');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');
//Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/user/home', 'HomeController@user')->name('user.home');
Route::get('/admin/home', 'HomeController@admin')->middleware('can:isAdmin')->name('admin.home');

/*Route::group(['namespace' => 'Inventory', 'prefix' => 'user'], function () {
    Route::resource('items', 'InventoryController')->names('user.inventory'); 
 });*/

//Адмінка
$groupData = [
    'namespace' => 'Inventory\Admin',
    'prefix' => 'admin',
];
Route::group($groupData, function () {
    //
   /* $methods = ['index','edit','store','update','create',];
    Route::resource('categories', 'CategoryController')
    ->only($methods)
    ->names('admin.categories');*/ 

    //Departments
    Route::resource('departments', 'DepartmentController')
    ->middleware('can:isAdmin')
    ->except(['show','destroy'])                              //не робити маршрут для метода show
    ->names('admin.departments');
 });