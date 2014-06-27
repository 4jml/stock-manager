<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		Category::create(array(
			'name' => 'BOUCHERIE',
			'section_id' => '1'
		));
		Category::create(array(
			'name' => 'VOLAILLES',
			'section_id' => '1'
		));
		Category::create(array(
			'name' => 'LÉGUMES FRAIS',
			'section_id' => '2'
		));
		Category::create(array(
			'name' => 'FRUITS FRAIS',
			'section_id' => '2'
		));
		Category::create(array(
			'name' => 'CÉRÉALES',
			'section_id' => '3'
		));
		Category::create(array(
			'name' => 'BISCUITS',
			'section_id' => '3'
		));
	}

}