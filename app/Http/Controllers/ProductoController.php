<?php

namespace App\Http\Controllers;

use App\MateriaPrima;
use App\Producto;
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
            'imagen' => 'required|image'
        ]);

        $file = $request->file('imagen');
        $extension = $file->getClientOriginalExtension();
        $fileName = auth()->id() . '.' . $extension;
        $request->name = $fileName;

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
}
