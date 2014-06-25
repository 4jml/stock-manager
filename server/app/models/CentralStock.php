<?php

class CentralStock extends Eloquent {
	public function product()
	{
		return $this->hasOne('Product');
	}
}