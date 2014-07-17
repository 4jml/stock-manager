<?php

class Order extends Eloquent {

    protected $softDelete = true;

	protected $fillable = array('supplier_id');

	public function orderLines()
	{
		return $this->hasMany('OrderLine');
	}

    public function supplier()
    {
        return $this->belongsTo('Supplier');
    }

}