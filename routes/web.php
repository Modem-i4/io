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
//Route::post('login', 'Auth\LoginController@login');  //Native Login User Form
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/user/home', 'HomeController@user')->name('user.home');
Route::get('/admin/home', 'HomeController@admin')->middleware('can:isAdmin')->name('admin.home');

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
    ->except(['create', 'show'])                              //не робити маршрут для метода show
    ->names('admin.departments');
    Route::post('/departments/update_ajax', 'DepartmentController@updateAjax')->name('admin.departments.updateAjax');

    //Users
    
 });
    
//API
Route::get('/api/departments/categories', 'Inventory\Admin\DepartmentController@categoriesApi')->middleware('can:isAdmin')->name('api.categories');
Route::get('/api/departments/all', 'Inventory\Admin\DepartmentController@allApi')->middleware('can:isAdmin')->name('api.dep.all');

    