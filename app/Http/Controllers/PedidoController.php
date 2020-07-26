<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::getPedidos();
        return view('pedidos/pedidosList',['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = Request()->productos;
        $arr_pedidos = [];
        foreach ($productos as $id => $cantidad) {
            if ( !empty($cantidad) ) {
                $arr_pedidos[] = (object) array("id" => (int)$id, "cantidad" => (int) $cantidad);
            }
        }

        if (empty($arr_pedidos)) {
            return back()->with("error", "Debe agregar al menos un producto");
        } else {
            // todo ok genero pedido
            $msn_error = Pedido::guardarPedido($arr_pedidos);

            if (empty($msn_error)) {
                return back()->withSuccess('El pedido se realizo correctamente');
            } else {
                return back()->with("error", $msn_error);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*****************************************************************
     * METODOS PARA LA API
     **********************************/

    /**
     * Recuperar listado de pedidos
    */
    public function indexApi()
    {
        $pedidos = Pedido::getPedidos();
        return response()->json(array(
            'pedidos' => $pedidos,
            'error' => false,
        ));
    }

    /**
     * Guarda Un nuevo perido
     */
    public function storeApi(Request $request)
    {
        $productos = Request()->productos;
        //return response()->json($productos);

        $arr_pedidos = [];
        foreach ($productos as $p) {
            if ( !empty( (int)$p['cantidad'] ) ) {
                $arr_pedidos[] = (object) array("id" => (int)$p['id'], "cantidad" => (int) $p['cantidad']);
            }
        }
/*
        if (empty($arr_pedidos)) {
            return response()->json(array("error" => true, "msn" => "Debe agregar al menos un producto"));
        } else {
            return response()->json($productos);
        }
*/

        if (empty($arr_pedidos)) {
            //return back()->with("error", "Debe agregar al menos un producto");
            return response()->json(array("error" => true, "msn" => "Debe agregar al menos un producto"));
        } else {
            // todo ok genero pedido
            $msn_error = Pedido::guardarPedido($arr_pedidos);

            if (empty($msn_error)) {
                return response()->json(array("error" => false, "msn" => "El pedido se realizo correctamente"));
            } else {
                return response()->json(array("error" => true, "msn" => $msn_error));
            }
        }
    }

}
