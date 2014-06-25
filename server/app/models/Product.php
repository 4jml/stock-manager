<?php

class Product extends Eloquent {

	protected $fillable = array('name', 'description', 'price', 'weight', 'barcode');

	public function suppliers()
	{
		return $this->belongsToMany('Supplier')->withTimestamps();
	}
	public function stock()
	{
		return $this->belongsTo('Stock');
	}
}