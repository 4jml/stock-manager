<?php

class SectionsTableSeeder extends Seeder {

	public function run()
	{
		Section::create(array(
			'name' => 'PRODUITS FRAIS',
		));
		Section::create(array(
			'name' => 'FRUITS & LÉGUMES',
		));
		Section::create(array(
			'name' => 'ÉPICERIE SALÉE',
		));
		Section::create(array(
			'name' => 'ÉPICERIE SUCRÉE',
		));
		Section::create(array(
			'name' => 'BOISSONS',
		));
		Section::create(array(
			'name' => 'SURGELÉS',
		));
		Section::create(array(
			'name' => 'HYGIÈNE & BEAUTÉ',
		));
	}

}