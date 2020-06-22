<?php

use App\Rol;
use App\User;
use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $rol_admin = Rol::where('nombre', 'admin')->first();
        $rol_usuario = Rol::where('nombre', 'usuario')->first();

        $user = new User();
        $user->nombre = 'Admin';
        $user->email = 'admin@ejemplo.com';
        $user->password = bcrypt('123');
        $user->estado = 0;
        $user->save();
        $user->roles()->attach($rol_admin);
        $user->roles()->attach($rol_usuario);

        $user = new User();
        $user->nombre = 'Usuario';
        $user->email = 'usuario@ejemplo.com';
        $user->password = bcrypt('123');
        $user->save();
        $user->roles()->attach($rol_usuario);
     }
}
