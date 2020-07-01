<?php

use App\Rol;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $rol_admin = Rol::where('nombre', 'admin')->first();
        $rol_base = Rol::where('nombre', 'base')->first();
        $rol_usuario = Rol::where('nombre', 'usuario')->first();

        $user = new User();
        $user->nombre = 'Usuario Admin';
        $user->email = 'usuario_admin@ejemplo.com';
        $user->password = bcrypt('123');
        $user->api_token = Str::random(80);
        $user->estado = 0;
        $user->save();
        $user->roles()->attach($rol_admin);
        $user->roles()->attach($rol_base);

        $user = new User();
        $user->nombre = 'Usuario Base';
        $user->email = 'usuario_base@ejemplo.com';
        $user->password = bcrypt('123');
        $user->api_token = Str::random(80);
        $user->save();
        $user->roles()->attach($rol_base);

        $user = new User();
        $user->nombre = 'Usuario';
        $user->email = 'usuario@ejemplo.com';
        $user->password = bcrypt('123');
        $user->api_token = Str::random(80);
        $user->save();
        $user->roles()->attach($rol_usuario);
     }
}
