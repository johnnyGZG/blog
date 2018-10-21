<?php

use Illuminate\Database\Seeder;

// Libreria para crear y asignar roles
use Spatie\Permission\Models\Role;

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
        // Se limpian las tablas
        Role::truncate();
        User::truncate();

        // Se crean los Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        // Se crea el usuario admin
        $admin = new User();
        $admin->name = 'Administrador';
        $admin->email = "pruebas@pruebas.com";
        $admin->password = bcrypt('123123');
        $admin->save();

        //Se asigna el rol creado al usuario admin
        $admin->assignRole($adminRole);

        //Se crea el usuario escritor
        $writer = new User();
        $writer->name = 'Usuario 2';
        $writer->email = "usuarioDos@pruebas.com";
        $writer->password = bcrypt('123123');
        $writer->save();

        //Se asigna el rol creado al usuario escritor
        $writer->assignRole($writerRole);
    }
}
