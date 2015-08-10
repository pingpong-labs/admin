<?php

namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class SupportServiceProvider extends ServiceProvider
{
    /**
     * The class aliases array.
     *
     * @var array
     */
    protected $aliases = [
        'Image' => 'Intervention\Image\Facades\Image',
    ];

    /**
     * The service provider classes array.
     *
     * @var array
     */
    protected $providers = [
        'Intervention\Image\ImageServiceProvider',
    ];

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        require __DIR__.'/../permissions.php';
        require __DIR__.'/../composers.php';
        require __DIR__.'/../helpers.php';
        require __DIR__.'/../observers.php';
        require __DIR__.'/../menus.php';
        require __DIR__.'/../routes.php';

        if (file_exists($path = app_path('menus.php'))) {
            require $path;
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerAliases();
    }

    /**
     * Register service providers.
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register class aliases.
     */
    public function registerAliases()
    {
        AliasLoader::getInstance($this->aliases)->register();
    }
}
