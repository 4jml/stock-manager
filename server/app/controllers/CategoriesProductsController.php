<?php

class CategoriesProductsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($categoryId)
	{
		$products = Product::where('category_id', $categoryId)->get();
		return Response::json($products);
	}

}