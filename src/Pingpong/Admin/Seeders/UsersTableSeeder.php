<?php namespace Pingpong\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\User;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'username' => 'pingpong',
            'email' => 'pingpong.labs@gmail.com',
            'password' => 'secret',
        ]);

        if ( ! $user->hasRole('admin')->first()) $user->roles()->attach(1);
    }

}