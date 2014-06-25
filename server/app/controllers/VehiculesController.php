<?php

class VehiculesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vehicules = Vehicule::all();

		return Response::json($vehicules);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), array(
			'make' => 'required|min:3',
			'model' => 'required|min:3',
			'plate' => 'required|min:3',
		));

		if ($validator->passes()) {
			$vehicule = Vehicule::create(Input::all());

			return Response::json($vehicule);
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
		$vehicule = Vehicule::findOrFail($id);

		return Response::json($vehicule);
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
			'make' => 'min:3',
			'model' => 'min:3',
			'plate' => 'min:3',
		));

		if ($validator->passes()) {
			$vehicule = Vehicule::find($id);
			$vehicule->fill(Input::all());
			$vehicule->save();

			return Response::json($vehicule);
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
		Vehicule::destroy($id);
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

		$vehicules = Vehicule::where('make', 'LIKE', $query)
						   ->orWhere('model', 'LIKE', $query)
						   ->get();

		return Response::json($vehicules);
	}

}
