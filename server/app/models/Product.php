<?php

class Product extends Eloquent {

    protected $softDelete = true;

	protected $fillable = array('name', 'description', 'price', 'weight', 'barcode', 'category_id');

    public function suppliers()
	{
		return $this->belongsToMany('Supplier')->withTimestamps();
	}

	public function stock()
	{
		return $this->belongsTo('Stock');
	}

    public function state()
    {
        // Remove the columns that aren't available in a product state.
        $data = array_intersect_key($this->toArray(), array_flip($this->fillable));

        // Create, if necessary, the state and return it.
        return ProductState::firstOrCreate($data);
    }
}