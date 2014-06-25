<?php

class Vehicule extends Eloquent {
	public $timestamps = false;

	protected $fillable = array('model', 'make', 'plate');
}