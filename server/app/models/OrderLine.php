<?php

class OrderLine extends Eloquent {

	protected $fillable = array('order_id', 'quantity');

    public function orders()
    {
        return $this->belongsTo('Order');
    }

}