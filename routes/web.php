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

$router->get('/buku', 'BooksController@index');

$router->get('/books/{id}', 'BooksController@getId');

$router->get('/bukus/{judul}', 'BooksController@getJudul');

$router->post('/buku', 'BooksController@createBuku');

$router->put('/books/{id}', 'BooksController@updateBuku');

$router->delete('/books/{id}', 'BooksController@deletebyId');
