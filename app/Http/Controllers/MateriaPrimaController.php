<?php

namespace App\Http\Controllers;

use App\CategoriaMP;
use Illuminate\Http\Request;
use App\MateriaPrima;
use App\UnidadMedida;
use MateriaPrimaSeeder;

class MateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $materias_primas = MateriaPrima::getPaginate(10);

        $view_list = view('materiasPrimasList', compact('materias_primas'));

        if ($request->ajax()) {
            return response()->json( ['materias_primas' => $materias_primas, 'view_list' => $view_list->render()] );
        } else {
            $unidad_medida = UnidadMedida::orderBy('descripcion', 'asc')->get();
            $categorias = CategoriaMP::orderBy('nombre', 'asc')->get();
            return view('materiasPrimas', compact('unidad_medida', 'materias_primas', 'view_list', 'categorias'));
        }

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
    public function store()
    {
        $info = Request()->validate([
            'nombre' => 'required',
            'unidad_medida_id' => 'required|numeric',
            'categoria_mp_id' => 'required|numeric',
            'cantidad' => 'required'
        ]);

        $mp = new MateriaPrima();
        $mp->nombre = $info['nombre'];
        $mp->unidad_medida_id = $info['unidad_medida_id'];
        $mp->categoria_mp_id = $info['categoria_mp_id'];
        $mp->cantidad = $info['cantidad'];
        $mp->estado = 0;
        $mp->save();

        return back()->withSuccess('La materia prima se agrego correctamente');
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
