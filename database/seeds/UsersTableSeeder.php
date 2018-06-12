<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User();

        $user->name = 'Administrador';

        $user->email = "pruebas@pruebas.com";

        $user->password = bcrypt('123123');

        $user->save();
    }
}
