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
    return $router->app->version();
});

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/me', 'AuthController@me');
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    /**
     * Routes for users
     */
    $router->get('/products', 'ProductController@index');
    $router->post('/products', 'ProductController@store');
    $router->get('/products/{product}', 'ProductController@show');
    $router->put('/products/{product}', 'ProductController@update');
    $router->patch('/products/{product}', 'ProductController@update');
    $router->delete('/products/{product}', 'ProductController@destroy');
    /**
     * Routes for users
     */
    $router->get('/users', 'UserController@index');
    $router->get('/users/{user}', 'UserController@show');
    $router->post('/users', 'UserController@store');
    $router->put('/users/{user}', 'UserController@update');
    $router->patch('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');
});
