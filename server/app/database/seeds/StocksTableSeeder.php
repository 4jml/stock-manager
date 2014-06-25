<?php

class StocksTableSeeder extends Seeder {

	public function run()
	{
		Stock::create(array(
			'shop_id' => '1',
			'product_id' => '1',
			'quantity' => '5',
		));
	}

}