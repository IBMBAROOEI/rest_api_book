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
// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register/{education_id}', 'AuthController@register');
    $router->post('login' ,'AuthController@login');
///bookmark
    $router->post('bookuser/{user_id}/store/{book_id}' ,'bookmarkcontroller@store');
    $router->post('bookuser/{user_id}/storedelete/{book_id}' ,'bookmarkcontroller@delete');

    ///like
    $router->post('bookuser/{user_id}/like/{book_id}' ,'likecontroller@like');
    $router->post('bookuser/{user_id}/dislike/{book_id}' ,'likecontroller@dislike');
    $router->get('bookuser/showlike/{book_id}' ,'likecontroller@show');
    ///route book
    $router->post('book/{user_id}/store/{category_id}' ,'bookcontroller@store');
    $router->get('book/get' ,'bookcontroller@index');
    $router->get('book/get/{book_id}' ,'bookcontroller@show');
    $router->PUT('book/{user_id}/update/{education_id}','bookcontroller@update');
    $router->delete('book/{user_id}/destroy/{education_id}','bookcontrollerdestroy');

//route categoryucation
    $router->post('category/store' ,'categorycontrooler@store');
    $router->get('category/get' ,'categorycontrooler@index');
    $router->PUT('category/update/{id}' ,'categorycontrooler@update');
    $router->delete('category/destroy/{id}','categorycontrooler@destroy');

    //route echocation
    $router->post('education/store' ,'echcationcontroller@store');
    $router->get('education/get' ,'echcationcontroller@index');
    $router->PUT('education/update/{id}','echcationcontroller@update');
    $router->delete('education/destroy/{id}','echcationcontroller@destroy');



    ///route user
//    $router->get('user/get' ,'usercontroller@index');
//    $router->PUT('education/update/{education_id}','usercontroller@update');
//    $router->delete('education/destroy/{education_id}','usercontroller@destroy');

});




