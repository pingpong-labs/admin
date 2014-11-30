<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
    protected $description = 'Install the admin package.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (getenv('PINGPONG_ADMIN_TESTING'))
        {
            $this->installPackageTest();
        }
        else
        {
            $this->installPackage();
        }
    }

    /**
     * Install package using testing environment.
     *
     * @return void
     */
    private function installPackageTest()
    {
        $this->call('admin:migration');

        $this->publishTrustyMigrations();

        $this->call('migrate');

        $this->call('admin:seed');

        $this->installMenus();

        // $this->call('dump-autoload');
    }

    /**
     * Install the package.
     *
     * @return void
     */
    protected function installPackage()
    {
        if ($this->confirm('Do you want publish the pingpong/admin\'s migrations ?'))
        {
            $this->call('admin:migration');
        }

        if ($this->confirm('Do you want publish the pingpong/trusty\'s migrations ?'))
        {
            if ($this->option('bench'))
            {
                $this->publishTrustyMigrations();
            }
            else
            {
                $this->call('migrate:publish', ['package' => 'pingpong/trusty']);
            }
        }

        if ($this->confirm('Do you want run all migrations now ?'))
        {
            $this->call('migrate');
        }

        if ($this->confirm('Do you want run the pingpong/admin\'s seeders now ?'))
        {
            $this->call('admin:seed');
        }

        if ($this->confirm('Do you want publish configuration files from pingpong/admin package ?'))
        {
            if( ! $this->option('bench'))
            {
                $this->call('config:publish', ['package' => 'pingpong/admin']);
            }
        }

        if ($this->confirm('Do you want publish assets from pingpong/admin package ?'))
        {
            if($this->option('bench'))
            {
                $this->call('asset:publish', ['--bench' => 'pingpong/admin']);
            }
            else
            {
                $this->call('asset:publish', ['package' => 'pingpong/admin']);
            }
        }

        if ($this->confirm('Do you want create the app/menus.php file ?'))
        {
            $this->installMenus();
        }

        $this->call('dump-autoload');
    }

    public function publishTrustyMigrations()
    {
        $path = realpath(__DIR__ . '/../../../../vendor/pingpong/trusty/src/migrations/');

        $published = $this->laravel['migration.publisher']->publish(
            $path, $this->laravel['path'] . '/database/migrations'
        );

        foreach ($published as $migration)
        {
            $this->line('<info>Published:</info> ' . basename($migration));
        }
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

            $this->info("Created : {$file}");
        }
        else
        {
            $this->error("File already exists at path : {$file}");
        }
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('--bench', null, InputOption::VALUE_NONE, 'Indicates the package is used in workbench.'),
        );
    }

}
