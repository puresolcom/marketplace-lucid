<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->get('/docs', function () {
    $swagger = \Swagger\scan(base_path('app'));

    return new \Illuminate\Http\JsonResponse($swagger);
});

$app->get('/', function () {
    return 'You\'re here cuz you\'re someone awesome!';
});
$app->get('/example', 'ExampleController@index');

/**
 * User
 */
$app->group(['prefix' => 'user'], function ($app) {
    $app->post('/login', 'UsersController@login');
    $app->post('/', 'UsersController@create');
    $app->group(['middleware' => ['auth']], function ($app) {
        $app->get('/{id}/roles', 'UsersController@getRoles');
        $app->get('/{id}', 'UsersController@get');
        $app->get('/', 'UsersController@index');
        $app->put('/{id}', 'UsersController@update');
        $app->delete('/{id}', 'UsersController@delete');
    });
});

/**
 * Role
 */
$app->group(['prefix' => 'role'], function ($app) {
    $app->group(['middleware' => ['auth']], function ($app) {
        $app->get('/{id}', 'RolesController@get');
        $app->get('/', 'RolesController@index');
        $app->post('/', 'RolesController@create');
        $app->put('/{id}', 'RolesController@update');
        $app->delete('/{id}', 'RolesController@delete');
    });
});

/**
 * Option
 */
$app->group(['prefix' => 'option'], function ($app) {
    $app->group(['middleware' => ['auth']], function ($app) {
        $app->get('/{id}', 'OptionsController@get');
        $app->get('/', 'OptionsController@index');
        $app->post('/', 'OptionsController@create');
        $app->put('/{id}', 'OptionsController@update');
        $app->delete('/{id}', 'OptionsController@delete');
    });
});

/**
 * Store
 */
$app->group(['prefix' => 'store'], function ($app) {
    $app->group(['middleware' => ['auth']], function ($app) {
        $app->get('/{id}', 'StoresController@get');
        $app->get('/', 'StoresController@index');
        $app->post('/', 'StoresController@create');
        $app->put('/{id}', 'StoresController@update');
        $app->delete('/{id}', 'StoresController@delete');
    });
});

/**
 * Store
 */
$app->group(['prefix' => 'currency'], function ($app) {
    $app->group(['middleware' => ['auth']], function ($app) {
        $app->get('/{id}', 'CurrenciesController@get');
        $app->get('/', 'CurrenciesController@index');
        $app->post('/', 'CurrenciesController@create');
        $app->put('/{id}', 'CurrenciesController@update');
        $app->delete('/{id}', 'CurrenciesController@delete');
    });
});