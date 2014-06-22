<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();

		if (Input::has('nesting')) {
			$products->load('suppliers');
		}

		return Response::json($products);
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
			'price' => 'required|numeric|max:999999.99',
			'weight' => 'required|numeric|max:999.999',
			'barcode' => 'required|alpha_num'
		));

		if ($validator->passes()) {
			$product = Product::create(Input::all());
			return Response::json($product);
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
		$product = Product::findOrFail($id);

		if (Input::has('nesting')) {
			$product->load('suppliers');
		}

		return Response::json($product);
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
			'price' => 'numeric|max:999999.99',
			'weight' => 'numeric|max:999.999',
			'barcode' => 'alpha_num'
		));

		if ($validator->passes()) {
			$product = Product::find($id);
			$product->fill(Input::all());
			$product->save();

			return Response::json($product);
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
		Product::destroy($id);
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

		$products = Product::where('name', 'LIKE', $query)
						   ->orWhere('description', 'LIKE', $query)
						   ->orWhere('price', 'LIKE', $query)
						   ->orWhere('weight', 'LIKE', $query)
						   ->orWhere('barcode', 'LIKE', $query)
						   ->get();

		return Response::json($products);
	}

}
