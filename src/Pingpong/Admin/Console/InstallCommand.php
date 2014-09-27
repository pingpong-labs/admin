<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call('migrate:publish', ['package' => 'pingpong/admin']);

        $this->call('migrate:publish', ['package' => 'pingpong/trusty']);

        $this->call('migrate');

        $this->call('admin:seed');

        $this->call('config:publish', ['package' => 'pingpong/admin']);

        $this->call('asset:publish', ['package' => 'pingpong/admin']);

        $this->call('view:publish', ['package' => 'pingpong/admin']);

        $this->installMenus();

        $this->call('dump-autoload');
    }

    /**
     * Create the menus.php file in app directory if that file does not exist.
     *
     * @return void
     */
    protected function installMenus()
    {
        $file = app_path('menus.php');

        if ( ! file_exists($file))
        {
            $contents = $this->laravel['files']->get(__DIR__ . '/stubs/menus.txt');

            $this->laravel['files']->put($file, $contents);
        }
    }

}
