<?php

class StockLogsTableSeeder extends Seeder {

	public function run()
	{
		StockLog::create(array(
			'shop_id' => '1',
			'product_id' => '1',
			'transport_id' => '1',
			'user_id' => '1',
			'lot' => 'ezfF32F43F0Y203',
			'quantity' => '5',
		));
	}
}