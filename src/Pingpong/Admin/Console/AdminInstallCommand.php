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
		$this->call('admin:migration');

		$this->call('migrate:publish', ['package' => 'pingpong/trusty']);
		
		$this->call('migrate');
		
		$this->call('db:seed', ['--class' => 'Pingpong\\Admin\\Seeders\\AdminDatabaseSeeder']);

		$this->call('config:publish', ['package' => 'pingpong/admin']);

		$this->call('asset:publish', ['package' => 'pingpong/admin']);

		$this->installMenus();

		$this->call('dump-autoload');
	}

	/**
	 * Create the menus.php file in app directory if that file does not exist.
	 *
	 * @return void
	 */
	protected function installMenus()
	{
		$file = app_path('menus.php');
		if( ! file_exists($file))
		{
			$contents = $this->laravel['files']->get(__DIR__.'/stubs/menus.txt');

			$this->laravel['files']->put($file, $contents);
		}		
	}

}
