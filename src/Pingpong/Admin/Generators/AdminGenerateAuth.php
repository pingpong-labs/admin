<?php namespace Pingpong\Admin\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminGenerateAuth extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:generate-auth';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate Auth Controller and View for Admin Package.';

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
		//controllers

		$controllerTxt = __DIR__.'/templates/AuthController.txt';
		$routesTxt = __DIR__.'/templates/routes.txt';

		$name = ucwords($this->argument('name')).'Controller';
		$controller = app_path().'/controllers/'. $name.'.php';

		if(file_exists($controller))
		{
			$this->error("Controller $name already exists. Please use different name.");
		}else{
			$search = array(
				'{{name}}'
			);
			$replace = array(
				$name
			);
			$controllerScript = file_get_contents($controllerTxt);
			
			$data = str_replace($search, $replace, $controllerScript);
			
			if(!file_put_contents($controller, $data))
			{				
				$this->error("Can not create : $controller.");
			}else{
				$this->info("Created $name in $controller.");
			}
		}

		// views
		$copyPath = __DIR__.'/templates/views/';
		$targetPath = app_path() .'/views/';
		
		if( ! \File::copyDirectory($copyPath, $targetPath))
		{
			$this->error("Can not copy views to $targetPath. Please copy manualy $targetPath to app/views folder.");
		}else{
			$this->info("Admin views published successfully.");
		}

		// update routes file
		$routesFile = app_path().'/routes.php';
		$appendFile = file_get_contents($routesTxt);
		
		$search = array(
			'{{name}}'
		);
		$replace = array(
			$name
		);
		$appendText = str_replace($search, $replace, $appendFile);

		if( ! \File::append($routesFile, $appendText))
		{
			$this->error("Can not append text to routes file.");
		}else{
			$this->info("Updated $routesFile");
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
			array('name', InputArgument::REQUIRED, 'Controller name.'),
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
			// array('namespace', null, InputOption::VALUE_OPTIONAL, 'Namespace controller.', null),
		);
	}

}
