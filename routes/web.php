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

Route::middleware('auth')->group(function() {
    Route::get('/user/home', 'HomeController@user')->name('user.home');
    Route::get('/admin/home', 'HomeController@admin')->middleware('can:isAdmin')->name('admin.home');


    $inventoryGroupData = [
        'namespace' => 'Inventory',
    ];
    Route::group($inventoryGroupData, function() {

        //TODO: user/home???
        //Route::get('profile', 'UserController@profile');


        //Адмінка
        $inventoryAdminGroupData = [
            'namespace' => 'Admin',
            'middleware' => 'can:isAdmin',
            'prefix' => 'admin',
        ];
        Route::group($inventoryAdminGroupData, function () {

            //Departments
            Route::resource('departments', 'DepartmentController')
                ->only(['index'])    //TODO винести онлі для всіх маршрутів
                ->names('admin.departments');

            //Users
            Route::resource('users', 'UserController')
                ->only(['index', 'show'])
                ->names('admin.users');

            //Types
            Route::resource('types', 'TypeController')
                ->only(['index'])
                ->names('admin.types');

            //Status
            Route::get('statuses', 'StatusController@index')
                ->name('admin.statuses.index');

            //licenses
            Route::resource('licenses', 'LicenseController')
                ->only(['index'])
                ->names('admin.licenses');

        });
    });
});



//Auth
$authGroupData = [
    'middleware' => 'guest',
    'namespace' => 'Auth',
];
Route::group($authGroupData, function() {
    //login with Google
    Route::get('/login/google/redirect', 'LoginController@redirectToProvider')->name('login.google.redirect');
    Route::get('/login/google/callback', 'LoginController@handleProviderCallback')->name('login.google.callback');

    Route::get('/', 'LoginController@google')->name('login');    //TODO: Improve
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');





//API
Route::group(['middleware' => ['can:isAdmin']], function () {

    $apiGroupData = [
        'namespace' => 'Api',
        'prefix' => 'api',
    ];

    Route::group($apiGroupData, function () {
        Route::get('users', 'UserController@index');

        Route::get('departments/all', 'DepartmentController@all');
        Route::delete('departments/destroy', 'DepartmentController@destroyMany');
        Route::resource('departments', 'DepartmentController')
            ->only(['index', 'update', 'store'])
            ->names('api.departments');

        Route::delete('types/destroy', 'TypeController@destroyMany');
        Route::resource('types', 'TypeController')
            ->only(['index', 'update', 'store'])
            ->names('api.types');
    });

});
