<?php

use App\UnidadMedida;
use Illuminate\Database\Seeder;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uni_med = new UnidadMedida();
        $uni_med->abreviatura = 'l';
        $uni_med->descripcion = 'Litros';
        $uni_med->save();

        $uni_med = new UnidadMedida();
        $uni_med->abreviatura = 'cc';
        $uni_med->descripcion = 'Centimetros Cubicos';
        $uni_med->save();

        $uni_med = new UnidadMedida();
        $uni_med->abreviatura = 'kg';
        $uni_med->descripcion = 'Kilos';
        $uni_med->save();

        $uni_med = new UnidadMedida();
        $uni_med->abreviatura = 'g';
        $uni_med->descripcion = 'Gramos';
        $uni_med->save();

        $uni_med = new UnidadMedida();
        $uni_med->abreviatura = 'uni';
        $uni_med->descripcion = 'Unidades';
        $uni_med->save();
    }
}
