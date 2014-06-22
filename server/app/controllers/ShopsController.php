<?php

class ShopsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Shop::all());
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
			'city' => 'min:3'
		));

		if ($validator->passes()) {
			$shop = Shop::create(Input::all());
			return Response::json($shop);
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
		$shop = Shop::findOrFail($id);
		return Response::json($shop);
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
			$shop = Shop::find($id);
			$shop->fill(Input::all());
			$shop->save();

			return Response::json($shop);
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
		Shop::destroy($id);
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

		$shops = Shop::where('name', 'LIKE', $query)
						   ->orWhere('description', 'LIKE', $query)
						   ->orWhere('address', 'LIKE', $query)
						   ->orWhere('zip', 'LIKE', $query)
						   ->orWhere('city', 'LIKE', $query)
						   ->get();

		return Response::json($shops);
	}

}
