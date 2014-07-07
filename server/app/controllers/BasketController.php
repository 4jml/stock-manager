<?php

class BasketController extends \BaseController {

	public function index()
	{
		return Response::json(Session::get('basket', array()));
	}

	public function store()
	{
		// Session::flush();
		Session::push('basket', Input::all()[0]);
		return Response::json(Session::get('basket', array()));
	}

	public function update($id)
	{
		Session::put('basket', Input::all());
		return Response::json(Session::get('basket', array()));
	}

	public function products() {
		$products = array();
		$products_cleaned = array_unique(Session::get('basket', array()));
		asort($products_cleaned);

		foreach ($products_cleaned as $entry)
		{
			$product = Product::find($entry);
			$product->quantity = count(array_keys(Session::get('basket', array()), $entry));
			array_push($products, $product->toArray());
		}

		return Response::json($products);
	}
}
