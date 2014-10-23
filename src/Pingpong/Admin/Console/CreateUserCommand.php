<?php namespace Pingpong\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Pingpong\Admin\Entities\Role;
use Pingpong\Admin\Entities\User;

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
		$name = $this->ask('Name : ');
		$email = $this->ask('Email : ');
		$username = $this->ask('Username : ');
		$password = \Hash::make($this->secret('password : '));

		$user = User::firstOrcreate(compact('name', 'username', 'email', 'password'));

		$this->line('Select role:');

		foreach (Role::all() as $role)
		{
			$this->line($role->id . '. ' . $role->name);
		}

		$role = $this->ask("Role number : ");

		$user->addRole($role);

		$this->info("User [{$user->name}] created successfully.");
	}

}
