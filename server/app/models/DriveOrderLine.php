<?php

class DriveOrderLine extends Eloquent {

	protected $fillable = array('quantity', 'availableQuantity');

    public function order()
    {
        return $this->belongsTo('DriveOrder');
    }
    public function productState()
    {
        return $this->belongsTo('ProductState');
    }

}