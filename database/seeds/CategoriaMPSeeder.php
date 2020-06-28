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
        $datos = [
            ['Carnes Rojas',0],
            ['Carnes Blancas',0],
            ['Condimentos',0],
            ['Aderezos',0],
            ['Liquido',0],
            ['Verduras',0],
            ['Harinas',0],
        ];

        foreach($datos as $d) {
            $cat = new CategoriaMP();
            $cat->nombre = $d[0];
            $cat->estado = $d[1];
            $cat->save();
        }
    }
}
