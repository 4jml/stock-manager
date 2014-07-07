<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	switch($request->headers->get('radian_app'))
	{
		case 'radian_drive':
		{
			Config::set('auth.model', 'Customer');
			Config::set('auth.table', 'customers');
		}
		break;
	}
});


App::after(function($request, $response)
{
	switch($request->headers->get('radian_app'))
	{
		case 'radian_drive':
			$origin = Config::get('app.radian_drive');
		break;
		default:
			$origin = Config::get('app.radian_drive');
	}

	$response->headers->set('Access-Control-Allow-Origin', $origin);
	$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
	$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, radian_app');
	$response->headers->set('Access-Control-Allow-Credentials', 'true');
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) {
		$response = Response::make(null, 401);
		return $response;
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});