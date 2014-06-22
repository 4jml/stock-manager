<?php

class SuppliersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$suppliers = Supplier::all();

		if (Input::has('nesting')) {
			$suppliers->load('products');
		}

		return Response::json($suppliers);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), array(
			'name' => 'required|min:3',
			'zip' => 'digits:5',
			'city' => 'min:3',
			'phone' => 'digits:10'
		));

		if ($validator->passes()) {
			$supplier = Supplier::create(Input::all());
			return Response::json($supplier);
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
		$supplier = Supplier::findOrFail($id);

		if (Input::has('nesting')) {
			$supplier->load('products');
		}

		return Response::json($supplier);
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
			'city' => 'min:3',
			'phone' => 'digits:10'
		));

		if ($validator->passes()) {
			$supplier = Supplier::find($id);
			$supplier->fill(Input::all());
			$supplier->save();

			return Response::json($supplier);
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
		Supplier::destroy($id);
		return Response::make();
	}


}
