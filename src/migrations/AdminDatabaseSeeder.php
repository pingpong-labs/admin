<?php

class AdminDatabaseSeeder extends \Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();
		$users = array(
			array(
				'fullname'		=>	'Administrator',
				'username'		=>	'admin',
				'email'			=>	'admin@example.com',
				'password'		=>	Hash::make('admin'),
				'created_at'	=>	new Datetime,
				'updated_at'	=>	new Datetime
			)
		);
		DB::table('users')->insert($users);		
	}

}