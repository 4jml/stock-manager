<?php

class OrderLine extends Eloquent {

	protected $fillable = array('order_id', 'product_id', 'quantity');

    public function order()
    {
        return $this->belongsTo('Order');
    }

    public function productState()
    {
        return $this->belongsTo('ProductState');
    }

}