<?php

class Stock extends Eloquent {
	public function shop()
	{
		return $this->hasOne('Shop');
	}
	public function product()
	{
		return $this->hasOne('Product');
	}
}