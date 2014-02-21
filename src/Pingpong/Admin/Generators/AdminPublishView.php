<?php namespace Pingpong\Admin\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminPublishView extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:publish-view';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish view from admin package.';

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
		// views
		$viewPath = __DIR__.'/templates/views/';
		$target = app_path('views');

		if(\File::copyDirectory($viewPath, $target))
		{
			$this->info('Views published successfully.');
		}else{
			$this->error('Error : Views published failed.');
		}
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
