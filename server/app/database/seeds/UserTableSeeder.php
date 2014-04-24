<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create(array(
			'username' => 'admin',
			'password' => Hash::make('test')
		));
	}

}