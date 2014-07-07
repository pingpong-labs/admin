<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminRefreshCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:refresh';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh the admin package.';

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
		$this->call('migrate:refresh');

		$this->call('migrate', ['--bench' => 'pingpong/admin']);
		
		$this->call('migrate', ['--package' => 'pingpong/auth']);
		
		$this->call('db:seed', ['--class' => 'Pingpong\\Admin\\Seeders\\AdminDatabaseSeeder']);

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
