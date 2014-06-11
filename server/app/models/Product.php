<?php

class Product extends Eloquent {

	protected $fillable = array('name', 'description', 'price', 'weight', 'barcode');

}