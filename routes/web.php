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

            //Invoices
            Route::resource('invoices', 'InvoiceController')
                ->only(['create', 'index', 'show'])
                ->names('admin.invoices');

            //Items
            Route::resource('items', 'ItemController')
                ->only(['index'])
                ->names('admin.items');

            //Licenses
            Route::resource('licenses', 'LicenseController')
                ->only(['index'])
                ->names('admin.licenses');

            //Models
            Route::resource('models', 'ModelController')
                ->only(['index'])
                ->names('admin.models');

            //Providers
            Route::resource('providers', 'ProviderController')
                ->only(['index'])
                ->names('admin.providers');

            //Statuses
            Route::get('statuses', 'StatusController@index')
                ->name('admin.statuses.index');

            //Types
            Route::resource('types', 'TypeController')
                ->only(['index'])
                ->names('admin.types');

            //Users
            Route::resource('users', 'UserController')
                ->only(['index', 'show'])
                ->names('admin.users');
            //Repairs
            Route::resource('repairs', 'RepairController')
                ->only(['index'])
                ->names('admin.repairs');
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
        // Departments
        Route::get('departments/all', 'DepartmentController@all');
        Route::delete('departments/destroy', 'DepartmentController@destroyMany');
        Route::resource('departments', 'DepartmentController')
            ->only(['index', 'update', 'store'])
            ->names('api.departments');

        //Invoices
        Route::resource('invoices', 'InvoiceController')
            ->only(['index', 'update', 'store'])
            ->names('api.invoices');

        //Items
        Route::get('items/all', 'ItemController@all');
        Route::resource('items', 'ItemController')
            ->only(['index', 'update'])
            ->names('api.items');

        //Licenses
        Route::resource('licenses', 'LicenseController')
            ->only(['index'])
            ->names('api.licenses');

        // Models
        Route::get('models/all', 'ModelController@all');
        Route::delete('models/destroy', 'ModelController@destroyMany');
        Route::resource('models', 'ModelController')
            ->only(['index', 'update', 'store'])
            ->names('api.models');

        // Providers
        Route::get('providers/all', 'ProviderController@all');
        Route::delete('providers/destroy', 'ProviderController@destroyMany');
        Route::resource('providers', 'ProviderController')
            ->only(['index', 'update', 'store'])
            ->names('api.providers');

        // Statuses
        Route::delete('statuses/destroy', 'StatusController@destroyMany');
        Route::resource('statuses', 'StatusController')
            ->only(['index', 'update', 'store'])
            ->names('api.statuses');

        // Types
        Route::get('types/all', 'TypeController@all');
        Route::delete('types/destroy', 'TypeController@destroyMany');
        Route::resource('types', 'TypeController')
            ->only(['index', 'update', 'store'])
            ->names('api.types');

        // Users
        Route::get('users/all', 'UserController@all');
        Route::get("users/my_id", function () { echo Illuminate\Support\Facades\Auth::id(); });
        Route::delete('users/destroy', 'UserController@destroyMany');
        Route::resource('users', 'UserController')
            ->only(['index', 'update', 'store'])
            ->names('api.users');

        // Repairs
        Route::get('repairs/all', 'RepairController@all');
        Route::delete('repairs/destroy', 'RepairController@destroyMany');
        Route::post('repairs/finish_repair/{item_id}', 'RepairController@updateEndDate');
        Route::resource('repairs', 'RepairController')
            ->only(['index', 'update', 'store'])
            ->names('api.repairs');

    });

});
