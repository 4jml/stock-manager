<?php

class CentralStockLogsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($productId)
	{
		$logs = CentralStockLog::where('product_id', $productId)->get();
		return Response::json($logs);
	}
}