<?php

use App\CategoriaMP;
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
        $this->call(RolTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(CategoriaMPSeeder::class);
        $this->call(MateriaPrimaSeeder::class);
        $this->call(ProductoSeeder::class);
    }
}
