<?php namespace Pingpong\Admin\Seeders;

class AdminDatabaseSeeder extends \Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(__NAMESPACE__ . '\\OptionsTableSeeder');
		$this->call(__NAMESPACE__ . '\\RolesTableSeeder');
		$this->call(__NAMESPACE__ . '\\PermissionsTableSeeder');
		$this->call(__NAMESPACE__ . '\\UsersTableSeeder');
	}

}
