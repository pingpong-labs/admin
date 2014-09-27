<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

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
    protected $description = 'Seed the pingpong/admin\'s seeders';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call('db:seed', [
            '--class' => 'Pingpong\\Admin\\Database\\Seeders\\AdminDatabaseSeeder'
        ]);
    }

}
