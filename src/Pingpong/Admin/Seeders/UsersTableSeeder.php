<?php

namespace Pingpong\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'email' => 'pingpong.labs@gmail.com',
            'password' => 'secret',
        ]);

        $user->addRole(1);
    }
}
