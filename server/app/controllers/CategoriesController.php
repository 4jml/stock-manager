<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		if (Input::has('nesting')) {
			$categories->load('section');
		}

		return Response::json($categories);
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
		));

		if ($validator->passes()) {
			$category = Category::create(Input::all());

			return Response::json($category);
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
		$category = Category::findOrFail($id);

		return Response::json($category);
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
		));

		if ($validator->passes()) {
			$category = Category::find($id);
			$category->fill(Input::all());
			$category->save();

			return Response::json($category);
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
		Category::destroy($id);
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

		$categories = Category::where('name', 'LIKE', $query)
						   ->get();

		return Response::json($categories);
	}

}
