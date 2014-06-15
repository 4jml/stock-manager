<?php

class UsersController extends BaseController {

	public function auth()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		$remember = Input::has('remember-me');

		if (Auth::attempt(array('username' => $username, 'password' => $password), $remember) || Auth::check()) {
			$user = Auth::user();
			return Response::json(array('id' => $user->id , 'username' => $user->username));
		}
		else {
			return Response::make(null, 401);
		}
	}
}
