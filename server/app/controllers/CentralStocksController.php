<?php

class CentralStocksController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = DB::table('products')->select('products.*', 'central_stocks.quantity')
										 ->join('central_stocks', 'products.id', '=', 'central_stocks.product_id')
										 ->get();
		return Response::json($products);
	}
}