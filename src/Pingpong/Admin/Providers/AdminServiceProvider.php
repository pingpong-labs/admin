<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Pingpong\Admin\Menus\Menu;

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
        $this->package('pingpong/admin', 'admin', __DIR__ . '/../../../');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function ($app)
        {
            Menu::setPresenter($app['config']->get('admin::menu.presenter'));

            include __DIR__ . '/../Http/routes.php';
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
