<?php

class Transport extends Eloquent {

    protected $softDelete = true;

    protected $fillable = array('driver_id', 'vehicule_id', 'start', 'end', 'departure', 'arrival');

	public function driver()
	{
		return $this->belongsTo('Driver');
	}

	public function vehicule()
	{
		return $this->belongsTo('Vehicule');
	}

    public function departure()
    {
        return $this->belongsTo('Shop', 'departure');
    }

    public function arrival()
    {
        return $this->belongsTo('Shop', 'arrival');
    }

    public function transportLines()
    {
        return $this->hasMany('TransportLine');
    }
}