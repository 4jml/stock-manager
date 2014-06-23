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

// Index
Route::get('/', function()
{
	return View::make('client::index');
});

// Authentication
Route::post('auth', 'UsersController@auth');

// All the routes that require authentication
Route::group(array('before' => 'auth'), function()
{
	// REST API
	Route::controller('users', 'UsersController');
	Route::resource('shops', 'ShopsController');
	Route::resource('products', 'ProductsController');
	Route::resource('products.suppliers', 'ProductsSuppliersController');
    Route::resource('suppliers', 'SuppliersController');
	Route::resource('suppliers.products', 'SuppliersProductsController');
	Route::resource('shops.products', 'ShopsProductsController');

	// Search engine
	Route::get('shops/search/{query}', 'ShopsController@search');
	Route::get('products/search/{query}', 'ProductsController@search');

});