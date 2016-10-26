<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
   
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/game', 'GameController@index');

Route::get('/manage', 'AdminController@manage');

Route::post('/beer/add', 'AmountBeerController@add');

Route::post('/pictures/add', 'PictureGameController@add');

Route::get('/vote/{picture}', 'PictureGameController@vote');

Route::post('/code/add', 'CodeGameController@add');

Route::post('/image/pick', 'PickImageController@add');

Route::get('/{user}/delete', 'AdminController@delete');