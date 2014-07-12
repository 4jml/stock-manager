<?php

class Category extends Eloquent {

	protected $fillable = array('name', 'section_id');

	public function section()
	{
		return $this->belongsTo('Section');
	}
}