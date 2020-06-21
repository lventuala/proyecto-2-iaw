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
        'nombre', 'descripcion', 'estado', 'nombre_img', 'img'
    ];

    public static function getPaginate($cant) {
        return Producto::
        select('producto.id', 'producto.nombre', 'producto.descripcion', 'producto.nombre_img', 'producto.img')
        ->where('producto.estado','0')
        ->orderBy('producto.nombre')
        ->paginate($cant);
    }

    public static function guardarProducto($prod,$file) {
        DB::transaction(function () use ($prod,$file) {
            // inserto producto
            $new_prod = new Producto();
            $new_prod->nombre = $prod['nombre'];
            $new_prod->descripcion = $prod['descripcion'];
            $new_prod->nombre_img = $prod['file_name'];
            $new_prod->img = base64_encode(file_get_contents($file));
            $new_prod->estado = 0;

            $new_prod->save();

            // inserto materia prima
            foreach( $prod['mp'] as $mp ) {
                $materia_prima = MateriaPrima::where('id',$mp['materia_prima_id'])->get();
                $new_prod->materiasPrimas()->attach($materia_prima, ['cantidad' => $mp['cantidad'], 'estado' => 0]);
            }
        });
    }

    public static function updateProducto($id,$prod,$file,$fileName) {
        DB::transaction(function () use ($id,$prod,$file,$fileName) {
            // actualizo datos del producto
            $new_prod = Producto::get($id);
            $new_prod->nombre = $prod['nombre'];
            $new_prod->descripcion = $prod['descripcion'];

            if ($file != null) {
                $new_prod->img = base64_encode(file_get_contents($file));
                $new_prod->nombre_img = $fileName;
            }

            $new_prod->save();

            foreach( $prod['mp'] as $mp ) {
                $existe = Producto::getMP($id,$mp['materia_prima_id']);
                if ( $existe ) {
                    // existe - actualizo cantidad
                    $new_prod->materiasPrimas()->updateExistingPivot($mp['materia_prima_id'],['cantidad' => $mp['cantidad']]);
                } else {
                    // no existe - lo agrego
                    $materia_prima = MateriaPrima::where('id',$mp['materia_prima_id'])->get();
                    $new_prod->materiasPrimas()->attach($materia_prima, ['cantidad' => $mp['cantidad']]);
                }
            }
        });
    }

    public static function get($id) {
        return Producto::where('id',$id)->get()->first();
    }

    public static function getMP($id,$id_mp) {
        return Producto::join('producto_mp', 'producto_mp.producto_id', '=', 'producto.id')
        ->select('producto_mp.materia_prima_id', 'producto_mp.cantidad')
        ->where('producto.id',$id)
        ->where('producto_mp.materia_prima_id',$id_mp)
        ->where('producto_mp.estado',0)
        ->get();
    }

    public static function getMP_all($id) {
        return Producto::join('producto_mp', 'producto_mp.producto_id', '=', 'producto.id')
        ->select('producto_mp.materia_prima_id', 'producto_mp.cantidad')
        ->where('producto.id',$id)
        ->where('producto_mp.estado',0)
        ->get();
    }

    public function materiasPrimas() {
        return $this
        ->belongsToMany(MateriaPrima::class, 'producto_mp', 'producto_id', 'materia_prima_id')
        ->withTimestamps();
    }
}
