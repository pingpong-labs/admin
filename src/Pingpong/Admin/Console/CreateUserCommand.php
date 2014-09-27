<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Pingpong\Admin\Entities\User;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateUserCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name = $this->ask("Name : ");
        $username = $this->ask("Username : ");
        $email = $this->ask("Email : ");
        $password = $this->secret("Password : ");

        $user = User::create(compact('name', 'username', 'email', 'password'));

        $this->info("User [{$user->name}] created successfully.");
    }

}
