<?php namespace Pingpong\Admin;

use Illuminate\Foundation\AliasLoader;
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
        'Pingpong\Menus\MenusServiceProvider',
        'Pingpong\Trusty\TrustyServiceProvider',
        'Pingpong\Admin\Providers\ConsoleServiceProvider',
        'Pingpong\Admin\Providers\ErrorServiceProvider',
    ];

    /**
     * The facades package.
     *
     * @var array
     */
    protected $facades = [
        'Menu' => 'Pingpong\Menus\Facades\Menu',
        'Role' => 'Pingpong\Trusty\Entities\Role',
        'Permission' => 'Pingpong\Trusty\Entities\Permission',
        'Trusty' => 'Pingpong\Trusty\Facades\Trusty',
    ];

    /**
     * Register the providers.
     *
     * @return void
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider)
        {
            $this->app->register($provider);
        }
    }

    /**
     * Register the facades.
     *
     * @return void
     */
    public function registerFacades()
    {
        AliasLoader::getInstance($this->facades);
    }

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

        $this->registerFacades();

        $this->registerRoutes();
    }

    /**
     * Register events.
     * 
     * @return void
     */
    public function registerRoutes()
    {
        $this->app->booted(function ()
        {
            $this->app['events']->fire('admin::routes'); 
        });   
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
