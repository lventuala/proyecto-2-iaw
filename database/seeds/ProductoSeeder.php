<?php

use App\MateriaPrima;
use App\Producto;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m1 = MateriaPrima::where('nombre','Papa')->get(['id'])->first();
        $m2 = MateriaPrima::where('nombre','Leche')->get(['id'])->first();
        $m3 = MateriaPrima::where('nombre','Nuez Moscada')->get(['id'])->first();
        $m4 = MateriaPrima::where('nombre','Sal')->get(['id'])->first();
        $m5 = MateriaPrima::where('nombre','Pimienta')->get(['id'])->first();
        $m6 = MateriaPrima::where('nombre','Medallon de Carne')->get(['id'])->first();
        $m7 = MateriaPrima::where('nombre','Tomate')->get(['id'])->first();
        $m8 = MateriaPrima::where('nombre','Lechuga')->get(['id'])->first();
        $m9 = MateriaPrima::where('nombre','Milanesa')->get(['id'])->first();
        $m10 = MateriaPrima::where('nombre','Huevo')->get(['id'])->first();
        $m11 = MateriaPrima::where('nombre','Relleno Empanadas Carne')->get(['id'])->first();
        $m12 = MateriaPrima::where('nombre','Tapas de Empanada')->get(['id'])->first();
        $m13 = MateriaPrima::where('nombre','Relleno Empanadas Pollo')->get(['id'])->first();

        // producto 1
        $prod = new Producto();
        $prod->nombre = 'Pure de Papas';
        $prod->descripcion = '---';
        $prod->nombre_img = 'pastel_de_papas.jpg';
        $prod->img = base64_encode(file_get_contents(public_path('images\pure_de_papas.jpg')));
        $prod->estado = 0;
        $prod->save();

        $prod->materiasPrimas()->attach($m1, ['cantidad' => 0.4, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m2, ['cantidad' => 0.1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m3, ['cantidad' => 0.1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m4, ['cantidad' => 0.1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m5, ['cantidad' => 0.1, 'estado' => 0]);

        // producto 2
        $prod = new Producto();
        $prod->nombre = 'Hamburguesa Simple';
        $prod->descripcion = '---';
        $prod->nombre_img = 'hamburguesa_simple.jpg';
        $prod->img = base64_encode(file_get_contents(public_path('images\hamburguesa_simple.jpg')));
        $prod->estado = 0;
        $prod->save();

        $prod->materiasPrimas()->attach($m6, ['cantidad' => 1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m7, ['cantidad' => 0.2, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m8, ['cantidad' => 0.1, 'estado' => 0]);

        // producto 3
        $prod = new Producto();
        $prod->nombre = 'Milanesa con Papas Fritas';
        $prod->descripcion = '---';
        $prod->nombre_img = 'mila_con_papas.jpg';
        $prod->img = base64_encode(file_get_contents(public_path('images\mila_con_papas.jpg')));
        $prod->estado = 0;
        $prod->save();

        $prod->materiasPrimas()->attach($m9, ['cantidad' => 0.3, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m10, ['cantidad' => 2, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m1, ['cantidad' => 0.4, 'estado' => 0]);

        // producto 4
        $prod = new Producto();
        $prod->nombre = 'Empanadas de Carne';
        $prod->descripcion = '---';
        $prod->nombre_img = 'empanada_carne.jpg';
        $prod->img = base64_encode(file_get_contents(public_path('images\empanada_carne.jpg')));
        $prod->estado = 0;
        $prod->save();

        $prod->materiasPrimas()->attach($m11, ['cantidad' => 0.1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m12, ['cantidad' => 1, 'estado' => 0]);

        // producto 4
        $prod = new Producto();
        $prod->nombre = 'Empanadas de Pollo';
        $prod->descripcion = '---';
        $prod->nombre_img = 'empanada_pollo.jpg';
        $prod->img = base64_encode(file_get_contents(public_path('images\empanada_pollo.jpg')));
        $prod->estado = 0;
        $prod->save();

        $prod->materiasPrimas()->attach($m13, ['cantidad' => 0.1, 'estado' => 0]);
        $prod->materiasPrimas()->attach($m12, ['cantidad' => 1, 'estado' => 0]);



    }
}
