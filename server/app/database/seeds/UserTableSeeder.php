<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		$user = User::create(array(
			'username' => 'admin',
			'password' => Hash::make('test')
		));
	}

}