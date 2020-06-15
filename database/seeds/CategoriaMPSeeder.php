<?php

use App\CategoriaMP;
use Illuminate\Database\Seeder;

class CategoriaMPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new CategoriaMP();
        $cat->nombre = 'Carnes Rojas';
        $cat->estado = 0;
        $cat->save();

        $cat = new CategoriaMP();
        $cat->nombre = 'Carnes Blancas';
        $cat->estado = 0;
        $cat->save();

        $cat = new CategoriaMP();
        $cat->nombre = 'Condimentos';
        $cat->estado = 0;
        $cat->save();

        $cat = new CategoriaMP();
        $cat->nombre = 'Aderezos';
        $cat->estado = 0;
        $cat->save();

        $cat = new CategoriaMP();
        $cat->nombre = 'Bebidas';
        $cat->estado = 0;
        $cat->save();
    }
}
