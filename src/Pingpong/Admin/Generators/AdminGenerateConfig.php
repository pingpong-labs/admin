<?php namespace Pingpong\Admin\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminGenerateConfig extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:generate-config';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate config file for resource admin.';

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
		$configTxt = __DIR__.'/templates/config.txt';

		$name = strtolower($this->argument('name')).'.php';
		$configFile = app_path().'/config/packages/pingpong/admin/resources/'. $name;

		$table 		= $this->option('table');
		$eloquent 	= $this->option('eloquent');

		if(file_exists($configFile))
		{
			$this->error("Config $name already exists. Please use different name.");
		}else{
			$search = array(
				'{{table}}',
				'{{eloquent}}',
			);
			$replace = array(
				$table,
				$eloquent
			);
			$script = file_get_contents($configTxt);
			
			$data = str_replace($search, $replace, $script);
			
			if(!file_put_contents($configFile, $data))
			{				
				$this->error("Can not create : $configFile.");
			}else{
				$this->info("Created $configFile.");
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'Config file name.'),
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
			array('table', null, InputOption::VALUE_OPTIONAL, 'Table name.', null),
			array('eloquent', null, InputOption::VALUE_OPTIONAL, 'Eloquent name.', null),
		);
	}

}
