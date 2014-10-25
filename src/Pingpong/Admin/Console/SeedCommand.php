<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SeedCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the seeders from pingpong/admin package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call('db:seed', ['--class' => 'Pingpong\\Admin\\Seeders\\AdminDatabaseSeeder']);
    }

}
