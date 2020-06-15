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
        $c_bebida = CategoriaMP::where('nombre','Bebidas')->get(['id'])->first();
        $c_condimento = CategoriaMP::where('nombre','Condimentos')->get(['id'])->first();
        $c_aderezo = CategoriaMP::where('nombre','Aderezos')->get(['id'])->first();

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

    }

}
