<?php

class Category extends Eloquent {

	protected $fillable = array('name');

	public function section()
	{
		return $this->belongsTo('Section');
	}
}