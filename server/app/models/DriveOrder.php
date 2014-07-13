<?php

class DriveOrder extends Eloquent {

	protected $fillable = array('customer_id', 'shop_id', 'date');

	public function lines()
	{
		return $this->hasMany('DriveOrderLine');
	}
	public function customer()
    {
        return $this->belongsTo('Customer');
    }

}