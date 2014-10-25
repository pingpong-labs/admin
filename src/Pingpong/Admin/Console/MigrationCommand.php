<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrationCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the migration file to the application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $path = realpath(__DIR__ . '/../../../../src/migrations/');

        $this->laravel['files']->copyDirectory($path, $this->laravel['path'] . '/database/migrations');

        $this->info("Migrations published successfully.");
    }

}
