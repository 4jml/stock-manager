<?php

class DriversController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$drivers = Driver::all();

		if (Input::has('nesting')) {
			$drivers->load('suppliers');
		}

		return Response::json($drivers);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), array(
			'lastname' => 'required|min:3',
		));

		if ($validator->passes()) {
			$driver = Driver::create(Input::all());

			return Response::json($driver);
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
		$driver = Driver::findOrFail($id);

		return Response::json($driver);
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
			'lastname' => 'min:3',
		));

		if ($validator->passes()) {
			$driver = Driver::find($id);
			$driver->fill(Input::all());
			$driver->save();

			return Response::json($driver);
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
		Driver::destroy($id);
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

		$drivers = Driver::where('lastname', 'LIKE', $query)
						   ->orWhere('firstname', 'LIKE', $query)
						   ->get();

		return Response::json($drivers);
	}

}
