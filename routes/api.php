<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

$apiGroupData = [
    'namespace' => 'Api',
];

Route::group($apiGroupData, function() {
    Route::get('users', 'UserController@index');
    Route::get('departments', 'DepartmentController@index')->name('api.departments');
});

//Dep
//Route::get('/api/departments/categories', 'Inventory\Admin\DepartmentController@categoriesApi')->middleware('can:isAdmin')->name('api.categories');

