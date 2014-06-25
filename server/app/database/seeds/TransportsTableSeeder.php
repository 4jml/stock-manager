<?php

class TransportsTableSeeder extends Seeder {

	public function run()
	{
		Transport::create(array(
			'driver_id' => '1',
			'vehicule_id' => '1',
		));
	}

}