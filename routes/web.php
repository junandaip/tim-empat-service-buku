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

$router->get('/key', function(){
    return str_random(32);
});

$router->get('/book', 'BooksController@index');

$router->get('/book/id/{id}', 'BooksController@getId');

$router->get('/book/judul/{judul}', 'BooksController@getJudul');

$router->post('/book', 'BooksController@createBuku');

$router->put('/book/{id}', 'BooksController@updateBuku');

$router->delete('/book/{id}', 'BooksController@deletebyId');
