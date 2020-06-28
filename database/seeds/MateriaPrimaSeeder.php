<?php

use App\CategoriaMP;
use App\MateriaPrima;
use App\UnidadMedida;
use Illuminate\Database\Seeder;

class MateriaPrimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $um_l = UnidadMedida::where('abreviatura','l')->get(['id'])->first();
        $um_cc = UnidadMedida::where('abreviatura','cc')->get(['id'])->first();
        $um_kg = UnidadMedida::where('abreviatura','kg')->get(['id'])->first();
        $um_g = UnidadMedida::where('abreviatura','g')->get(['id'])->first();
        $um_uni = UnidadMedida::where('abreviatura','uni')->get(['id'])->first();

        $c_carnes_r = CategoriaMP::where('nombre','Carnes Rojas')->get(['id'])->first();
        $c_carnes_b = CategoriaMP::where('nombre','Carnes Blancas')->get(['id'])->first();
        $c_bebida = CategoriaMP::where('nombre','Liquido')->get(['id'])->first();
        $c_condimento = CategoriaMP::where('nombre','Condimentos')->get(['id'])->first();
        $c_aderezo = CategoriaMP::where('nombre','Aderezos')->get(['id'])->first();
        $c_verdura = CategoriaMP::where('nombre','Verduras')->get(['id'])->first();
        $c_harinas = CategoriaMP::where('nombre','Harinas')->get(['id'])->first();

        $datos = [
            ['Acelga',5,0,$um_kg->id,$c_verdura->id],
            ['Espinaca',5,0,$um_kg->id,$c_verdura->id],
            ['Papa',30,0,$um_kg->id,$c_verdura->id],
            ['Cebolla',10,0,$um_kg->id,$c_verdura->id],

            ['Vino Blanco',10,0,$um_l->id,$c_bebida->id],
            ['Vino Tinto',10,0,$um_l->id,$c_bebida->id],
            ['Leche',5,0,$um_l->id,$c_bebida->id],
            ['Pure de Tomate',5,0,$um_l->id,$c_bebida->id],

            ['Carne Picada',30,0,$um_kg->id,$c_carnes_r->id],
            ['Pollo',20,0,$um_kg->id,$c_carnes_b->id],
            ['Pescado',20,0,$um_kg->id,$c_carnes_b->id],

            ['Ajo en Polvo',500,0,$um_g->id,$c_condimento->id],
            ['Pimienta',500,0,$um_g->id,$c_condimento->id],
            ['Aji Molido',500,0,$um_g->id,$c_condimento->id],
            ['Oregano',500,0,$um_g->id,$c_condimento->id],

            ['Tapas de Empanada',100,0,$um_uni->id,$c_harinas->id],
            ['Tallarines',10,0,$um_kg->id,$c_harinas->id],

            ['Mayonesa',5,0,$um_kg->id,$c_aderezo->id],
            ['Savora',5,0,$um_kg->id,$c_aderezo->id],
            ['ketchup',5,0,$um_kg->id,$c_aderezo->id],
        ];

        foreach($datos as $d) {
            $mp = new MateriaPrima ();
            $mp->nombre = $d[0];
            $mp->cantidad = $d[1];
            $mp->estado = $d[2];
            $mp->unidad_medida_id = $d[3];
            $mp->categoria_mp_id = $d[4];
            $mp->save();
        }
/*
        $mp = new MateriaPrima ();
        $mp->nombre = 'Papas';
        $mp->cantidad = 30;
        $mp->estado = 0;
        $mp->unidad_medida_id = $um_kg->id;
        $mp->categoria_mp_id = $c_verdura->id;
        $mp->save();

        $mp = new MateriaPrima ();
        $mp->nombre = 'Vino Blanco';
        $mp->cantidad = 25;
        $mp->estado = 0;
        $mp->unidad_medida_id = $um_l->id;
        $mp->categoria_mp_id = $c_bebida->id;
        $mp->save();

        $mp = new MateriaPrima ();
        $mp->nombre = 'Vino Tinto';
        $mp->cantidad = 20;
        $mp->estado = 0;
        $mp->unidad_medida_id = $um_l->id;
        $mp->categoria_mp_id = $c_bebida->id;
        $mp->save();

        $mp = new MateriaPrima ();
        $mp->nombre = 'Pollo';
        $mp->cantidad = 10;
        $mp->unidad_medida_id = $um_kg->id;
        $mp->categoria_mp_id = $c_carnes_b->id;
        $mp->estado = 0;
        $mp->save();
*/
    }

}
