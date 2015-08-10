<?php

namespace Pingpong\Admin;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
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
        'Pingpong\Admin\Providers\RepositoriesServiceProvider',
    ];

    /**
     * The facades package.
     *
     * @var array
     */
    protected $facades = [
        'Menu' => 'Pingpong\Menus\MenuFacade',
        'Role' => 'Pingpong\Trusty\Entities\Role',
        'Permission' => 'Pingpong\Trusty\Entities\Permission',
        'Trusty' => 'Pingpong\Trusty\Facades\Trusty',
    ];

    /**
     * Register the providers.
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the facades.
     */
    public function registerFacades()
    {
        AliasLoader::getInstance($this->facades);
    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $configPath = config_path('admin.php');

        $this->publishes([
            __DIR__.'/../../config/config.php' => $configPath,
        ], 'config');

        $this->publishes([
            __DIR__.'/../../../public/' => public_path('packages/pingpong/admin/'),
        ], 'assets');

        $viewPath = base_path('resources/views/vendor/pingpong/admin/');

        $this->publishes([
            __DIR__.'/../../views/' => $viewPath,
        ], 'views');

        if (file_exists($configPath)) {
            $this->mergeConfigFrom($configPath, 'admin');
        }

        $this->loadViewsFrom([$viewPath, __DIR__.'/../../views'], 'admin');

        $langPath = base_path('resources/lang/en/admin.php');

        $this->publishes([
            __DIR__.'/../../lang/admin.php' => $langPath,
        ], 'lang');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerProviders();

        $this->registerFacades();

        $this->registerRoutes();
    }

    /**
     * Register events.
     */
    public function registerRoutes()
    {
        $this->app->booted(function () {
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
