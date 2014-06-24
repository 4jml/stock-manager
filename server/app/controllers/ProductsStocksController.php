<?php

class ProductsStocksController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($productId)
	{
		$shops = DB::table('shops')->select('shops.*', 'stocks.quantity')
										 ->join('stocks', 'shops.id', '=', 'stocks.product_id')
										 ->where('stocks.product_id', $productId)
										 ->get();
		return Response::json($shops);
	}
}