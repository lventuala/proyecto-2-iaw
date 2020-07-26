<?php

namespace App\Http\Controllers;

use App\MateriaPrima;
use App\Pedido;
use App\Producto;
use App\View\Components\productoForm;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private $cant_paginas = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Request()->page ?? 1;
        $materias_primas = MateriaPrima::getAllActivas();

        $view_list = $this->_getListado($page);

        $datos = [
            'materias_primas' => $materias_primas,
            'view_list' => $view_list
        ];

        if (Request()->ajax()) {
            return response()->json($datos);
        } else {
            return view('productos/productos',$datos);
        }
    }

    /**
     * Recuperar productos desde la API
     */
    public function productos() {
        $page = Request()->page ?? 1;
        $productos = Producto::getAll();
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);
        }

        return response()->json(["productos" => $productos]);
    }

    /**
     * Recuperar productos desde la WEB
     */
    public function productosWeb() {
        $page = Request()->page ?? 1;
        $productos = Producto::getAll();
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);
        }

        return view('inicio',['productos' => $productos]);
    }

    /**
     * Mostrar los productos para realizar un pedido
     */
    public function productosPedidos() {
        $productos = Producto::getAll();
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);

            // calculo cantidad maxima para pedir
            $prod = Producto::get($p->id);
            $materias_primas = $prod->getMP_all($p->id);
            $max = 0;
            foreach ($materias_primas as $mp) {
                $mprima = MateriaPrima::get($mp->materia_prima_id);
                $max_aux = $mprima->cantidad / $mp->cantidad;
                if ( $max === 0 ) {
                    $max = $max_aux;
                } else {
                    $max = min($max,$max_aux);
                }
            }

            $p->cant_maxima = $max;
        }

        return view('productos/productosPedidos',["productos" => $productos]);
    }

    private function _getListado($page) {
        $productos = Producto::getPaginate($this->cant_paginas);
        return view('productos/productosList', compact('productos','page'))->render();
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

        $result = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'mp.*.materia_prima_id' => 'required|numeric',
            'mp.*.cantidad' => 'required|numeric|min:0.1',
            'imagen' => 'required|image',
            'file_name' => 'required'
        ]);

        $file = $request->file('imagen');

        Producto::guardarProducto($result,$file);

        $view_list = $this->_getListado(1);

        if (Request()->ajax()) {
            return response()->json( ['view_list' => $view_list] );
        } else {
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
        // recupero el producto
        $producto = Producto::get($id);
        $materias_primas = MateriaPrima::getAllActivas();
        $producto_mp = Producto::getMP_all($id);

        // preparo formulario para mostrar ( en este caso con datos del producto )
        $productoForm = new productoForm($materias_primas,$producto,$producto_mp);
        $view_form = $productoForm->renderConParametros()->render();

        // devuelvo html con el formulario (para mostra por ajax)
        if (Request()->ajax()) {
            return response()->json([
                    'view_form' => $view_form,
                    'productos_mp' => $producto_mp
                ]);
        }
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
        $result = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'mp.*.materia_prima_id' => 'required|numeric',
            'mp.*.cantidad' => 'required|numeric|min:0.1'
        ]);

        $file = null;
        $fileName = null;
        if (isset($request->imagen)) {
            $request->validate([
                'imagen' => 'required|image',
                'file_name' => 'required'
            ]);

            $file = $request->file('imagen');
            $fileName = $request['file_name'];
        }

        Producto::updateProducto($id,$result,$file,$fileName);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mp = Producto::get($id);
        $mp->estado = 1;
        $mp->save();

        // vuelvo a la vista con mensaje de exito
        return back()->withSuccess('El producto se elimino correctamente');
    }

    /*****************************************************************
     * METODOS PARA LA API
     **********************************/

    public function indexApi(Request $request)
    {
        $page = $request->page ?? 1;
        $materias_primas = MateriaPrima::getAllActivas();

        $productos = Producto::getPaginate($this->cant_paginas);
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);

            $mps = Producto::getMP_all($p->id);
            $p->mps = $mps;
        }

        $datos = [
            'productos' => $productos,
            'materias_primas' => $materias_primas,
            'page' => $page
        ];

        // devuelvo resultados
        return response()->json($datos);
    }

    /**
     * Mostrar los productos para realizar un pedido
     */
    public function productosPedidosApi() {
        $productos = Producto::getAll();
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);

            // calculo cantidad maxima para pedir
            $prod = Producto::get($p->id);
            $materias_primas = $prod->getMP_all($p->id);
            $max = 0;
            foreach ($materias_primas as $mp) {
                $mprima = MateriaPrima::get($mp->materia_prima_id);
                $max_aux = $mprima->cantidad / $mp->cantidad;
                if ( $max === 0 ) {
                    $max = round($max_aux,2);
                } else {
                    $max = round(min($max,$max_aux),2);
                }
            }

            $p->cant_maxima = $max;
            $p->cantidad = 0;
        }

        $datos = [
            'productos' => $productos,
        ];

        return response()->json($datos);
    }

    public function updateApi(Request $request, $id)
    {

        $result = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'mps.*.materia_prima_id' => 'required|numeric',
            'mps.*.cantidad' => 'required|numeric|min:0.1'
        ]);

        /*
        $file = null;
        $fileName = null;
        if (isset($request->imagen)) {
            $request->validate([
                'imagen' => 'required|image',
                'file_name' => 'required'
            ]);

            $file = $request->file('imagen');
            $fileName = $request['file_name'];
        }

        //Producto::updateProducto($id,$result,$file,$fileName);
        */

        $datos = [
            'id' => $id,
            'result' => $result
        ];

        return response()->json($datos);
    }

}
