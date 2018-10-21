<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Desabilita la revision de las llaves foraneas (esto se hace por que al ejecutar el seeder de los roles genera error - 'trncate')
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);

        // Habilita la revision de las llaves foraneas)
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
