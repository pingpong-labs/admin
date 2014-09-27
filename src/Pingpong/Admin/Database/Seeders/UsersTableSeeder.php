<?php namespace Pingpong\Admin\Seeders;

use Pingpong\Admin\Entities\User;

class UsersTableSeeder extends \Seeder {

	public function run()
	{
		$user = User::create([
			'name'		=>	'Administrator',
			'username'	=>	'pingpong',
			'email'		=>	'info@pingpong.web.id',
			'password'	=>	'secret',
		]);

		if( ! $user->hasRole('admin')->first()) $user->roles()->attach(1);
	}

}