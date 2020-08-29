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
//Route::post('login', 'Auth\LoginController@login');  //Native Login User
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
    ->except(['show'])                              //не робити маршрут для метода show
    ->names('admin.departments');
 });
    Route::post('/admin/departments/update_ajax', 'Inventory\Admin\DepartmentController@updateAjax');
//    Route::delete('/admin/departments/destroyMany/{id}', 'Inventory\Admin\DepartmentController@destroyMany')->middleware('can:isAdmin')->name('destroyMany');
    Route::get('/admin/departments/categories', 'Inventory\Admin\DepartmentController@categories')->middleware('can:isAdmin')->name('api.categories');

    

 /*Route::get('/livetable', 'Inventory\Admin\DepartmentController@index');
 Route::get('/livetable/fetch_data', 'Inventory\Admin\DepartmentController@fetch_data');
 Route::post('/livetable/add_data', 'Inventory\Admin\DepartmentController@add_data')->name('livetable.add_data');
 Route::post('/livetable/update_data', 'Inventory\Admin\DepartmentController@update_data')->name('livetable.update_data');
 Route::post('/livetable/delete_data', 'Inventory\Admin\DepartmentController@delete_data')->name('livetable.delete_data');*/

 /*Route::group(['namespace' => 'Inventory', 'prefix' => 'user'], function () {
    Route::resource('items', 'InventoryController')->names('user.inventory'); 
 });*/

// Route::get('student','Inventory\Admin\DepartmentController@index');
//Route::post('student','Inventory\Admin\DepartmentController@store')->name('student.store');
//Route::get('student/{id}/edit', 'Inventory\Admin\DepartmentController@edit')->name('student.edit');
//Route::post('student/update', 'Inventory\Admin\DepartmentController@update')->name('student.update');
//Route::get('student/{id}', 'Inventory\Admin\DepartmentController@destroy')->name('student.delete');