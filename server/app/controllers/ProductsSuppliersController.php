<?php

class ProductsSuppliersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($productId)
	{
		$suppliers = Product::findOrFail($productId)->suppliers;
		return Response::json($suppliers);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function store($productId)
	{
		Product::findOrFail($productId)->suppliers()->sync(Input::all());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($productId, $supplierId)
	{
		Product::findOrFail($productId)->suppliers()->attach($supplierId);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($productId, $supplierId)
	{
		Product::findOrFail($productId)->suppliers()->detach($supplierId);
	}

}