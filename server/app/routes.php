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

// Public API
Route::resource('sections', 'SectionsController');
Route::resource('sections.categories', 'SectionsCategoriesController');
Route::resource('categories.products', 'CategoriesProductsController');
Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::get('basket/products', 'BasketController@products');
Route::resource('basket', 'BasketController');
Route::resource('shops', 'ShopsController');
Route::post('customers/auth', 'CustomersController@auth');
Route::get('customers/disconnect', 'CustomersController@disconnect');
Route::get('customers/check/{email}', 'CustomersController@check');
Route::resource('customers', 'CustomersController');
Route::resource('drive/orders', 'DriveOrdersController');

// All the routes that require authentication
Route::group(array('before' => 'auth'), function()
{
	// REST API
	Route::controller('users', 'UsersController');

	Route::resource('shops.products', 'ShopsProductsController');

	Route::resource('products.suppliers', 'ProductsSuppliersController');
	Route::resource('products.stocks', 'ProductsStocksController');

    Route::resource('suppliers', 'SuppliersController');
	Route::resource('suppliers.products', 'SuppliersProductsController');

	Route::resource('vehicules', 'VehiculesController');
	Route::resource('drivers', 'DriversController');

	Route::resource('orders', 'OrdersController');
	Route::resource('orders.lines', 'OrderLinesController');

	Route::resource('drive/orderlines', 'DriveOrderLinesController');

	Route::resource('central/stocks', 'CentralStocksController');
	Route::resource('central/stocks/logs', 'CentralStockLogsController');

	// Search engine
	Route::get('shops/search/{query}', 'ShopsController@search');
	Route::get('products/search/{query}', 'ProductsController@search');
	Route::get('drivers/search/{query}', 'DriversController@search');
	Route::get('vehicules/search/{query}', 'VehiculesController@search');

});