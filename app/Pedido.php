<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    protected $table = 'pedido';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'usuario_id', 'estado'
    ];

    /**
     * Recupera un pedido particular
     */
    public static function get($id) {
        return Pedido::where('id',$id)->get()->first();
    }

    /**
     * Recuperar los pedidos generados por el usuario
     */
    public static function getPedidos() {
        $pedidos = Pedido::where('pedido.usuario_id',Auth::user()->id)->get();

        foreach($pedidos as $p) {
            $productos = Pedido::
            join('pedido_producto','pedido_producto.pedido_id','=','pedido.id')
            ->select('pedido_producto.producto_id', 'pedido_producto.cantidad')
            ->where('pedido.id',$p->id)
            ->get();

            $arr_productos = [];
            foreach($productos as $prod) {
                $producto = Producto::get($prod->producto_id);
                $producto->img = stream_get_contents($producto->img);
                $producto->cantidad = $prod->cantidad;
                $arr_productos[] = $producto;
            }

            $p->productos = $arr_productos;
        }

        return $pedidos;
    }

    /**
     * Crear un nuevo pedido
     */
    public static function guardarPedido($pedidos) {
        DB::beginTransaction();
        $msn_error = "";
        try {
            $pedido = new Pedido();
            $pedido->usuario_id = Auth::user()->id;
            $pedido->save();

            foreach($pedidos as $p) {
                // recupero el producto
                $producto = Producto::get($p->id);

                // recupero materias primas y resto cantidades
                $mp = $producto->getMP_all($p->id);
                foreach($mp as $m) {
                    $cant_solicitada = $p->cantidad * $m->cantidad;
                    $mprima = MateriaPrima::get($m->materia_prima_id);

                    // chequeo que exista la cantidad necesaria
                    if ($mprima ->cantidad < $cant_solicitada) {
                        $msn_error = "No hay la cantidad necesaria de : ".$producto->nombre;
                        throw new Exception();
                    }

                    // todo ok -> actualizo cantidad y guardo info
                    $mprima->cantidad = $mprima->cantidad - $cant_solicitada;
                    $mprima->update();
                }

                $pedido->productos()->attach($producto,['cantidad' => $p->cantidad]);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        } finally {
            return $msn_error;
        }
    }

    public function productos() {
        return $this
        ->belongsToMany(Producto::class, 'pedido_producto', 'pedido_id', 'producto_id')
        ->withTimestamps();
    }
}
