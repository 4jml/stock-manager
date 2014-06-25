<?php

class StockLog extends Eloquent {
	public function shop()
	{
		return $this->hasOne('Shop');
	}
	public function product()
	{
		return $this->hasOne('Product');
	}
	public function transport()
	{
		return $this->hasOne('Transport');
	}
	public function user()
	{
		return $this->hasOne('User');
	}
}