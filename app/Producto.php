<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected $table = 'producto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion', 'estado', 'img'
    ];

    public static function getPaginate($cant) {
        return Producto::
        select('producto.id', 'producto.nombre', 'producto.descripcion', 'producto.img')
        ->where('producto.estado','0')
        ->orderBy('producto.nombre')
        ->paginate($cant);
    }

    public static function guardarProducto($prod, $file) {
        DB::transaction(function () use ($prod,$file) {
            // inserto producto
            $new_prod = new Producto();
            $new_prod->nombre = $prod['nombre'];
            $new_prod->descripcion = $prod['descripcion'];
            $new_prod->img = base64_encode(file_get_contents($file));
            $new_prod->estado = 0;

            $new_prod->save();

            // inserto materia prima
            foreach( $prod['mp'] as $mp ) {
                $materia_prima = MateriaPrima::where('id',$mp['materia_prima_id'])->get();
                $new_prod->materiasPrimas()->attach($materia_prima, ['cantidad' => $mp['cantidad']]);
            }
        });
    }

    public function materiasPrimas() {
        return $this
        ->belongsToMany(MateriaPrima::class, 'producto_mp', 'producto_id', 'materia_prima_id')
        ->withTimestamps();
    }
}
