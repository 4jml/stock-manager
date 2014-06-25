<?php

class DriversTableSeeder extends Seeder {

	public function run()
	{
		Driver::create(array(
			'lastname' => 'DELORME',
			'firstname' => 'Jonathan',
		));
		Driver::create(array(
			'lastname' => 'PARDANAUD',
			'firstname' => 'Johann',
		));
	}

}