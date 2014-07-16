<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create(array(
			'username' => 'admin',
			'password' => Hash::make('test')
		));
		User::create(array(
			'username' => 'driveDeliver',
			'password' => Hash::make('test')
		));
	}

}