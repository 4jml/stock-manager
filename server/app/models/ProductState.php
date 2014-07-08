<?php

class ProductState extends Product {

    protected $softDelete = false;
    public $timestamps = false;
    protected $table = 'product_states';

}