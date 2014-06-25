<?php

class VehiculesTableSeeder extends Seeder {

	public function run()
	{
		Vehicule::create(array(
			'make' => 'RENAULT',
			'model' => 'Truck',
			'plate' => 'XX-XXXX-XX',
		));
		Vehicule::create(array(
			'make' => 'MERCEDES',
			'model' => 'Truck',
			'plate' => 'YY-YYYY-YY',
		));
	}

}