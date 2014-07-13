<?php

class DriveOrderLine extends Eloquent {

	protected $fillable = array('driveorder_id', 'product_state_id', 'quantity');

    public function order()
    {
        return $this->belongsTo('DriveOrder');
    }

}