<?php

namespace Pingpong\Admin;

use Illuminate\Support\ServiceProvider;
use Config;
use Pingpong\Admin\Generators as Generators;


class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Array providers.
	 *
	 * @var array
	 */
	protected $providers = array(
		'admin'		=>	'Pingpong\Admin\Admin',
		'resource'	=>	'Pingpong\Admin\Resource',
	);
	
	/**
	 * Array facades.
	 *
	 * @var array
	 */
	protected $facades = array(
		'Admin'		=>	'Pingpong\Admin\Facades\Admin',
		'Resource'	=>	'Pingpong\Admin\Facades\Resource',
	);

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('pingpong/admin', 'admin');
		$this->includeFiles();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{				
		$this->registerProviders();
		$this->registerFacades();
		$this->registerGenerators();
	}

	/**
	 * Include files.
	 *
	 * @return void
	 */
	protected function includeFiles()
	{
		include __DIR__.'/../../filters.php';
		include __DIR__.'/../../routes.php';

		Config::addNamespace('resources', app_path('config/packages/pingpong/admin/resources/'));
	}

	/**
	 * Register the generators.
	 *
	 * @return void
	 */
	public function registerGenerators()
	{	
		$this->app['admin.setup'] = $this->app->share(function($app)
		{
		        return new Generators\AdminSetup;
		});
		$this->app['admin.generate-auth'] = $this->app->share(function($app)
		{
		        return new Generators\AdminGenerateAuth;
		});
		$this->app['admin.generate-config'] = $this->app->share(function($app)
		{
		        return new Generators\AdminGenerateConfig;
		});
	        $this->commands(
	            'admin.setup',
	            'admin.generate-auth',
	            'admin.generate-config'
	        );
	}

	/**
	 * Register all service providers.
	 *
	 * @return void
	 */
	protected function registerProviders()
	{
		$providers = $this->providers;
		foreach ($providers as $key => $value) {
			$this->app[$key] = $this->app->share(function($app) use ($value)
			{
				return new $value;
			});
		}
	}

	/**
	 * Register all facades.
	 *
	 * @return void
	 */
	protected function registerFacades()
	{
		$facades = $this->facades;
		$this->app->booting(function() use ($facades)
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			foreach ($facades as $key => $value) {
				$loader->alias($key, $value);
			}
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		$providers = array();
		foreach ($this->providers as $key => $value) {
			$providers[] = $key;
		}
		return $providers;
	}

}
