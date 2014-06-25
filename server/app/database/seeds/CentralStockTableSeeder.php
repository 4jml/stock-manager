<?php

class CentralStocksTableSeeder extends Seeder {

	public function run()
	{
		CentralStock::create(array(
			'product_id' => '1',
			'quantity' => '10',
		));
	}

}