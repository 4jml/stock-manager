<?php

class TransportLine extends Eloquent {

	protected $fillable = array('transport_id', 'product_id', 'quantity');

    public function transport()
    {
        return $this->belongsTo('Transport');
    }

    public function productState()
    {
        return $this->belongsTo('ProductState');
    }

}