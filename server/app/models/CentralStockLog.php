<?php

class CentralStockLog extends Eloquent {
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