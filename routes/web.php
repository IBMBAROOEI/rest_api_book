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
$router->get('/key', function () {
    return \Illuminate\Support\Str::random(32);
});
$router->get('/', function () use ($router) {

    return $router->app->version();
});
///register and login
$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');


// API route group
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
///bookmark
    $router->post('bookuser/{user_id}/store/{book_id}', 'BookmarkController@store');
    $router->post('bookuser/{user_id}/storedelete/{book_id}', 'BookmarkController@delete');

    ///like
    $router->post('bookuser/{user_id}/like/{book_id}', 'likeController@like');
    $router->post('bookuser/{user_id}/dislike/{book_id}', 'likeController@dislike');
    $router->get('bookuser/showlike/{book_id}', 'likeController@show');


    /// book
    $router->post('book/store', 'BookController@store');
    $router->get('book/get', 'BookController@index');
    $router->get('book/get/{book_id}', 'BookController@show');
    $router->post('book/{book_id}/update/', 'BookController@update');/* update book */
    $router->delete('book/{book_id}/destroy/', 'BookController@destroy');

    //route echocation
    $router->post('education/store', 'EchcationController@store');
    $router->get('education/get', 'EchcationController@index');
    $router->put('education/update/{id}', 'EchcationController@update');
    $router->delete('education/destroy/{id}', 'EchcationController@destroy');
///serch
    $router->get('serch', 'SerchController@index');

///user
    $router->post('user/update/{user_id}', 'UserController@update');/* update user */
    $router->post('user', 'UserController@user');
    $router->delete('user/destroy/{user_id}', 'UserController@destroy');



    //route category
    $router->post('category/store', 'Admin\CategoryController@store');
    $router->get('category/get', 'Admin\CategoryController@index');
    $router->PUT('category/update/{id}', 'Admin\CategoryController@update');
    $router->delete('category/destroy/{id}', 'Admin\CategoryController@destroy');

    //status book active or disable
    $router->post('book/status/{book_id}', 'Admin\Book_Controller@bookstatus');
});
