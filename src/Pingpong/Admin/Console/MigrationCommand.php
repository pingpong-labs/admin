<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrationCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:migration';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Copy the migration file to the application.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$destinationPath = app_path('database/migrations');
		
		$migrationPath   = __DIR__ . '/../../../migrations/';
		
		if($this->laravel['files']->copyDirectory($migrationPath, $destinationPath))
		{
			return $this->info('Migration published!');
		}

		return $this->error('Unable to copy the migration.'); 
	}

}
