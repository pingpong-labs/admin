<?php namespace Pingpong\Admin\Seeders;

use Pingpong\Trusty\Entities\Role;

class RolesTableSeeder extends \Seeder {

	public function run()
	{
		Role::create([
			'name'		=>	'Administrator',
			'slug'		=>	'admin'
		]);

		Role::create([
			'name'		=>	'User',
			'slug'		=>	'user'
		]);
	}

}