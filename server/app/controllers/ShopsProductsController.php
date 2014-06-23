<?php

class ShopsProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($shopId)
	{
		$products = DB::table('products')->select('products.*', 'stocks.quantity')
										 ->join('stocks', 'products.id', '=', 'stocks.product_id')
										 ->where('stocks.shop_id', $shopId)
										 ->get();
		return Response::json($products);
	}
}