<?php

class Section extends Eloquent {

	protected $fillable = array('name');

	public function categories()
	{
		return $this->hasMany('Category');
	}
}