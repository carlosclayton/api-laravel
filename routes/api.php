<?php

use Illuminate\Http\Request;


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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('contacts', 'ContactsController@store')->name('contacts.store');

Route::post('biometries', 'BiometryController@store')->name('biometries.store');
Route::post('biometries/save_biometry', 'BiometryController@saveBiometry')->name('biometries.save_biometry');
Route::post('biometries/catraca', 'BiometryController@catraca')->name('biometries.catraca');


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group([
        'namespace' => 'ApiVue\Http\Controllers\Auth',
        'as' => 'api'
    ], function ($api) {
        $api->post('/password/forgot', [
            'uses' =>'ForgotPasswordController@sendResetLinkEmail',
            'middleware' =>['api.throttle'],
            'limit' => 5,
            'expires' => 1
        ])->name('.password.forgot');
        $api->post('/register', [
            'uses' =>'RegisterController@store',
            'middleware' =>['api.throttle'],
            'limit' => 5,
            'expires' => 1
        ])->name('.register.create');

        $api->post('/access_token', [
            'uses' =>'LoginController@accessToken',
                'middleware' =>['api.throttle'],
                'limit' => 5,
                'expires' => 1
        ])->name('.access_token');

        $api->post('/logout', [
            'uses' => 'LoginController@logout',
            'middleware' =>['api.throttle', 'api.auth'],
            'limit' => 5,
            'expires' => 1
        ])->name('.logout');

        $api->post('/refresh_token', [
            'uses' => 'LoginController@refreshToken',
            'middleware' =>['api.throttle', 'api.auth'],
            'limit' => 10,
            'expires' => 1
        ])->name('.refresh_token');

    });

    $api->group([
        'namespace' => 'ApiVue\Http\Controllers',
        'prefix' => 'users',
        'as' => 'users',
        'middleware' =>['api.throttle', 'api.auth'],
    ], function ($api) {
        $api->get('/', 'UsersController@index')->name('.index');
        $api->get('/trashed', 'UsersController@trashed')->name('.trashed');
        $api->get('/{user}', 'UsersController@show')->name('.show');
        $api->post('/', 'UsersController@store')->name('.store');
        $api->put('/{user}', 'UsersController@update')->name('.update');
        $api->delete('/{user}', 'UsersController@destroy')->name('.destroy');
        $api->put('/restore/{user}', 'UsersController@restore')->name('.restore');

    });

    $api->group([
        'namespace' => 'ApiVue\Http\Controllers',
        'prefix' => 'categories',
        'as' => 'categories',
        'middleware' =>['api.throttle', 'api.auth'],
    ], function ($api) {
        $api->get('/', 'CategoriesController@index')->name('.index');
        $api->get('/trashed', 'CategoriesController@trashed')->name('.trashed');
        $api->get('/{category}', 'CategoriesController@show')->name('.show');
        $api->post('/', 'CategoriesController@store')->name('.store');
        $api->put('/{category}', 'CategoriesController@update')->name('.update');
        $api->delete('/{category}', 'CategoriesController@destroy')->name('.destroy');
        $api->put('/restore/{category}', 'CategoriesController@restore')->name('.restore');

    });

    $api->group([
        'namespace' => 'ApiVue\Http\Controllers',
        'prefix' => 'products',
        'as' => 'products',
        'middleware' =>['api.throttle', 'api.auth'],
    ], function ($api) {
        $api->get('/', 'ProductsController@index')->name('.index');
        $api->get('/trashed', 'ProductsController@trashed')->name('.trashed');
        $api->get('/{product}', 'ProductsController@show')->name('.show');
        $api->post('/', 'ProductsController@store')->name('.store');
        $api->put('/{product}', 'ProductsController@update')->name('.update');
        $api->delete('/{product}', 'ProductsController@destroy')->name('.destroy');
        $api->put('/restore/{product}', 'ProductsController@restore')->name('.restore');
    });

    $api->group([
        'namespace' => 'ApiVue\Http\Controllers',
        'prefix' => 'clients',
        'as' => 'clients',
        'middleware' =>['api.throttle', 'api.auth'],
    ], function ($api) {
        $api->get('/', 'ClientsController@index')->name('.index');
        $api->get('/trashed', 'ClientsController@trashed')->name('.trashed');
        $api->get('/{client}', 'ClientsController@show')->name('.show');
        $api->post('/', 'ClientsController@store')->name('.store');
        $api->put('/{client}', 'ClientsController@update')->name('.update');
        $api->delete('/{client}', 'ClientsController@destroy')->name('.destroy');
        $api->put('/restore/{client}', 'ClientsController@restore')->name('.restore');
    });


    $api->group([
        'namespace' => 'ApiVue\Http\Controllers',
        'prefix' => 'orders',
        'as' => 'orders',
        'middleware' =>['api.throttle', 'api.auth'],
    ], function ($api) {
        $api->get('/', 'OrdersController@index')->name('.index');
        $api->get('/trashed', 'OrdersController@trashed')->name('.trashed');
        $api->get('/{order}', 'OrdersController@show')->name('.show');
        $api->post('/', 'OrdersController@store')->name('.store');
        $api->put('/{order}', 'OrdersController@update')->name('.update');
        $api->delete('/{order}', 'OrdersController@destroy')->name('.destroy');
        $api->put('/restore/{order}', 'OrdersController@restore')->name('.restore');

    });

});