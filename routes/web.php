<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return [
        'name' => env('APP_NAME', 'Lumen'),
        'lumen' => $router->app->version()
    ];
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/user', 'AuthController@user');
        $router->post('/logout', 'AuthController@logout');
        $router->post('/password/change', 'AuthController@passwordChange');

        $router->get('/users', 'UserController@index');
        $router->get('/users/{id}', 'UserController@show');
        $router->put('/users/{id}', 'UserController@update');

        $router->get('/posts', 'PostController@index');
        $router->post('/posts', 'PostController@store');
        $router->get('/posts/{id}', 'PostController@show');
        $router->put('/posts/{id}', 'PostController@update');
        $router->delete('/posts/{id}', 'PostController@destroy');
    });
});
