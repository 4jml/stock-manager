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
		$shop = Shop::create(Input::all());

		return Response::json($shop);
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
		$shop = Shop::find($id);
		$shop->fill(Input::all());
		$shop->save();

		return Response::json($shop);
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
