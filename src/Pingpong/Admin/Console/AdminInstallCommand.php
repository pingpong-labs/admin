<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the admin package.';

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
		$this->call('migrate', ['package' => 'pingpong/admin']);

		$this->call('migrate', ['package' => 'pingpong/trusty']);
		
		$this->call('db:seed', ['--class' => 'Pingpong\\Admin\\Seeders\\AdminDatabaseSeeder']);

		$this->call('config:publish', ['package' => 'pingpong/admin']);

		$this->call('asset:publish', ['package' => 'pingpong/admin']);

	}

}
