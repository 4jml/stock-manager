<?php

class Driver extends Eloquent {
	public $timestamps = false;

	protected $fillable = array('lastname', 'firstname');
}