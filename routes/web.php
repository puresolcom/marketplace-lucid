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

$app->group(['prefix' => 'users'], function ($app) {
    $app->post('/', 'UsersController@create');
    $app->group(['middleware' => ['auth', 'role:administrator']], function ($app) {
        $app->get('/', 'UsersController@index');
        $app->get('/{id}', 'UsersController@get');
        $app->get('/{id}/roles', 'UsersController@getUserRoles');
        $app->put('/{id}', 'UsersController@update');
        $app->delete('/{id}', 'UsersController@delete');
    });
});

$app->group(['prefix' => 'roles'], function ($app) {
    $app->group(['middleware' => ['auth', 'role:administrator']], function ($app) {
        $app->get('/', 'RolesController@index');
        $app->get('/{id}', 'RolesController@get');
        $app->post('/', 'RolesController@create');
        $app->put('/{id}', 'RolesController@update');
        $app->delete('/{id}', 'RolesController@delete');
    });
});
