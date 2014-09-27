<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider {

    /**
     * The list of support files.
     *
     * @var array
     */
    protected $files = [
        'helpers'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function ()
        {
            $this->registerSupportFiles();
        });
    }

    /**
     * Register the support files.
     */
    protected function registerSupportFiles()
    {
        foreach ($this->files as $file)
        {
            include __DIR__ . '/../Support/' . $file . '.php';
        }
    }


}