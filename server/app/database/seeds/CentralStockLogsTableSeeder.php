<?php

class CentralStockLogsTableSeeder extends Seeder {

	public function run()
	{
		CentralStockLog::create(array(
			'product_id' => '1',
			'user_id' => '1',
			'quantity' => '10',
			'lot' => 'FEHZIH493493HS',
		));
	}

}