<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('client::index');
});

Route::post('auth', 'UsersController@auth');

Route::group(array('before' => 'auth'), function()
{
	// API REST
	Route::controller('users', 'UsersController');
	Route::resource('shops', 'ShopsController');
	Route::resource('products', 'ProductsController');

	// SEARCH ENGINE
	Route::get('shops/search/{query}', 'ShopsController@search');
	Route::get('products/search/{query}', 'ProductsController@search');
});