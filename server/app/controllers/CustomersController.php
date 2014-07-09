<?php

class CustomersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (! Auth::check() or Config::get('auth.model') != 'User')
			App::abort(403, 'Unauthorized action.');
		return Response::json(Customer::all());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), array(
			'lastname' => 'required|min:2',
		));
		if ($validator->passes()) {
			$customer = new Customer;
			$customer->fill(Input::all());
			$customer->password = Hash::make(Input::get('password'));
			$customer->save();
			Auth::login($customer);
			return Response::json($customer);
		} else {
			return Response::json($validator->messages(), 400);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$customer = Customer::findOrFail($id);
		return Response::json($customer);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), array(
			'name' => 'min:3',
			'zip' => 'digits:5',
			'city' => 'min:3'
		));

		if ($validator->passes()) {
			$customer = Customer::find($id);
			$customer->fill(Input::all());
			$customer->save();

			return Response::json($customer);
		} else {
			return Response::json($validator->messages(), 400);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Customer::destroy($id);
		return Response::make();
	}


	/**
	 * Search resources from storage.
	 *
	 * @param  string  $query
	 * @return Response
	 */
	public function search($query)
	{
		$query = '%' . trim($query). '%';

		$customers = Customer::where('name', 'LIKE', $query)
						   ->orWhere('description', 'LIKE', $query)
						   ->orWhere('address', 'LIKE', $query)
						   ->orWhere('zip', 'LIKE', $query)
						   ->orWhere('city', 'LIKE', $query)
						   ->get();

		return Response::json($customers);
	}

	public function auth()
	{
		$email = Input::get('email');
		$password = Input::get('password');

		if (Auth::attempt(array('email' => $email, 'password' => $password), false) || Auth::check()) {
			$customer = Auth::user();
			return Response::json($customer->toArray());
		}
		else {
			return Response::make(null, 401);
		}
	}

	public function disconnect()
	{
		Auth::logout();

		return new Response(null, 200);
	}

	public function check($email)
	{
		if (Customer::where('email', $email)->count()) {
			return Response::json(false);
		}
		else {
			$code = rand(0, 9999);
			Session::put('code', $code);
			Mail::send('emails.drive.register_code', array('code' => $code), function($message) use ($email)
			{
				$message->from(Config::get('app.drive_from'), Config::get('app.drive_name'));
				$message->to($email);
				$message->setSubject("Code d'inscription");
			});
			return Response::json(true);
		}

		return Response::json($customers);
	}
}
