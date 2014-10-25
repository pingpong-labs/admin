<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The available command shortname.
     *
     * @var array
     */
    protected $commands = [
        'Seed',
        'Refresh',
        'Install',
        'Migration',
        'CreateUser',
    ];

    /**
     * Register the commands.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->commands as $command)
        {
            $this->commands('Pingpong\\Admin\\Console\\' . $command . 'Command');
        }
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = [];

        foreach ($this->commands as $command)
        {
            $provides[] = 'Pingpong\\Admin\\Console\\' . $command . 'Command';
        }

        return $provides;
    }

}