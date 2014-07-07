<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminControllerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:controller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a restful controller.';

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
		if( ! class_exists('Way\Generators\GeneratorServiceProvider'))
		{
			return $this->error("Please install way/generators package first!");
		}

		return $this->generate();
	}

	/**
	 * Generate the controller.
	 * 
	 * @return void
	 */
	public function generate()
	{
		$stub = __DIR__ . '/stubs/controller.txt';
		$path = __DIR__ . '/../Controllers/';

		$this->call('generate:controller', [
			'controllerName'=>	$this->argument('controller'),
			'--path'		=>	$path,
			'--templatePath'=>	$stub
		]);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('controller', InputArgument::REQUIRED, 'The Controller Name.'),
		);
	}
}
