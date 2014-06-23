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

	public function expose()
	{
		$base = $this->toArray();

		foreach ($base['suppliers'] as $key => $supplier)
			$base['suppliers'][$key] = $supplier['id'];

		return $base;
	}
}