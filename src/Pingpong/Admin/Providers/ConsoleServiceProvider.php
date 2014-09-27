<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider {

    /**
     * The list of console.
     *
     * @var array
     */
    protected $commands = [
        'CreateUserCommand',
        'InstallCommand',
        'SeedCommand'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->commands as $command)
        {
            $this->commands('Pingpong\\Admin\\Console\\' . $command);
        }
    }

}