<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider {

    /**
     * The list of filter class handler.
     *
     * @var array
     */
    protected $filters = [
        'admin.auth' => 'AdminAuthFilter',
        'admin.guest' => 'AdminGuestFilter',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function ($app)
        {
            $this->registerFilters();
        });
    }

    /**
     * Register all filters.
     *
     * @return void
     */
    protected function registerFilters()
    {
        foreach ($this->filters as $name => $filter)
        {
            $this->app['router']->filter($name, 'Pingpong\\Admin\\Http\\Filters\\' . $filter);
        }
    }

}