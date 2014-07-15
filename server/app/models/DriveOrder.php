<?php

class DriveOrder extends Eloquent {

	protected $fillable = array('customer_id', 'user_id', 'shop_id', 'date', 'prepared');

	public function lines()
	{
		return $this->hasMany('DriveOrderLine');
	}
	public function customer()
    {
        return $this->belongsTo('Customer');
    }
	public function user()
    {
        return $this->belongsTo('User');
    }

}