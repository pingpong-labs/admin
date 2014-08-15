<?php namespace Pingpong\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('pingpong/admin');
		$this->registerFiles();
	}

	/**
	 * Register the required files.
	 *
	 * @return void
	 */
	protected function registerFiles()
	{
		require __DIR__.'/permissions.php';
		require __DIR__.'/routes.php';
		require __DIR__.'/filters.php';
		require __DIR__.'/composers.php';
		require __DIR__.'/helpers.php';
		require __DIR__.'/menus.php';
		require __DIR__.'/observers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();
	}

	/**
	 * Register the commands.
	 * 
	 * @return void
	 */
	public function registerCommands()
	{
		$this->app['pingpong.console.install'] = $this->app->share(function($app)
		{
			return new Console\AdminInstallCommand;
		});
		
		$this->app['pingpong.console.refresh'] = $this->app->share(function($app)
		{
			return new Console\AdminRefreshCommand;
		});

		$this->app['pingpong.console.controller'] = $this->app->share(function($app)
		{
			return new Console\AdminControllerCommand;
		});

		$this->app['pingpong.console.migration'] = $this->app->share(function($app)
		{
			return new Console\AdminMigrationCommand;
		});

		$this->commands([
			'pingpong.console.install',
			'pingpong.console.refresh',
			'pingpong.console.controller',
			'pingpong.console.migration',
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
