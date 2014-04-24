<?php

class ShopTableSeeder extends Seeder {

	public function run()
	{
		Shop::create(array(
			'name' => 'Premier magasin',
			'description' => 'Premier magasin ouvert en France',
			'address' => '53 Avenue Victor Hugo',
			'zip' => '75116',
			'city' => 'Paris'
		));

		Shop::create(array(
			'name' => 'Second magasin',
			'description' => 'Second magasin ouvert en France',
			'address' => '26 Rue Victor Hugo',
			'zip' => '69002',
			'city' => 'Lyon'
		));
	}

}