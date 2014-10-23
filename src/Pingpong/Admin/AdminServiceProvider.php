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
	 * The providers package.
	 * 
	 * @var array
	 */
	protected $providers = [
		'Console',
		'Error',
		'Filter',
		'Support'
	];

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('pingpong/admin');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerProviders();
	}

	/**
	 * Register the providers.
	 * 
	 * @return void
	 */
	public function registerProviders()
	{
		foreach ($this->providers as $provider)
		{
			$this->app->register('Pingpong\\Admin\\Providers\\' . $provider . 'ServiceProvider');
		}
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
