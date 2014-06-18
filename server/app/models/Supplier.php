<?php

class Supplier extends Eloquent {

	protected $fillable = array('name', 'address', 'zip', 'city', 'phone');

	public function products()
	{
		return $this->belongsToMany('Product')->withTimestamps();
	}

}