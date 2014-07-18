<?php

class StockLogsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($shopId, $productId)
	{
		$logs = StockLog::where('shop_id', $shopId)->where('product_id', $productId)->get();
		return Response::json($logs);
	}
}