<?php

class SectionsCategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($sectionId)
	{
		$categories = Category::where('section_id', $sectionId)->get();
		return Response::json($categories);
	}

}