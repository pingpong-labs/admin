<?php namespace Pingpong\Admin\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminSetup extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:setup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Setup administrator.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$class 		= 'AdminDatabaseSeeder';
		$package 	= 'pingpong/admin';

		$this->call('config:publish', array('package' => $package));
		$this->call('asset:publish', array('package' => $package));
		$this->call('migrate', array('--package' => $package));
		$this->call('db:seed', array('--class' => $class));
		$this->call('admin:generate-auth', array('name'	=>	'Auth'));

		$this->info('Setup successfully.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
