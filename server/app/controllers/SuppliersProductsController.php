<?php

class SuppliersProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($supplierId)
	{
		$products = Supplier::findOrFail($supplierId)->products;
		return Response::json($products);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($supplierId, $productId)
	{
		Supplier::findOrFail($supplierId)->products()->attach($productId);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($supplierId, $productId)
	{
		Supplier::findOrFail($supplierId)->products()->detach($productId);
	}

}