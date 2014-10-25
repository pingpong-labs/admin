<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RefreshCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the migration and re-seed the database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call('migrate:refresh');

        $this->call('admin:seed');
    }

}
