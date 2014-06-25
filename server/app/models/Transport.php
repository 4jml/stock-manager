<?php

class Transport extends Eloquent {
	public function driver()
	{
		return $this->hasOne('Driver');
	}
	public function vehicule()
	{
		return $this->hasOne('Vehicule');
	}
}