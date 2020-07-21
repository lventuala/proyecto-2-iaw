<?php

namespace App\Http\Controllers;

use App\CategoriaMP;
use Illuminate\Http\Request;
use App\MateriaPrima;
use App\UnidadMedida;
use App\View\Components\mpForm;
use Validator;

class MateriaPrimaController extends Controller
{
    private $unidad_medida;
    private $categorias;

    public function __construct() {
        $this->unidad_medida = UnidadMedida::orderBy('descripcion', 'asc')->get();
        $this->categorias = CategoriaMP::orderBy('nombre', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;

        // recupero materias primas paginando de a 10
        $materias_primas = MateriaPrima::getPaginate(10);

        // recupero vista con listado de materias primas (para paginar por ajax)
        $view_list = view('materiasPrimas/materiasPrimasList', compact('materias_primas','page'))->render();

        // preparo datos para enviar
        $datos = [
            'materias_primas' => $materias_primas,
            'view_list' => $view_list,
            'categorias' => $this->categorias,
            'unidad_medida' => $this->unidad_medida
        ];

        // devuelvo resultados (para ajax datos y sino devuelvo la vista)
        if ($request->ajax()) {
            return response()->json($datos);
        } else {
            return view('materiasPrimas/materiasPrimas', $datos);
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
        // valido datos de entrada
        $info = Request()->validate([
            'nombre' => 'required',
            'unidad_medida_id' => 'required|numeric',
            'categoria_mp_id' => 'required|numeric',
            'cantidad' => 'required'
        ]);

        // preparo la materia prima y guardo
        $mp = new MateriaPrima();
        $mp->nombre = $info['nombre'];
        $mp->unidad_medida_id = $info['unidad_medida_id'];
        $mp->categoria_mp_id = $info['categoria_mp_id'];
        $mp->cantidad = $info['cantidad'];
        $mp->estado = 0;
        $mp->save();

        // vuelvo a la vista con mensaje de exito
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
        // recupero materia prima por el id
        $mp = MateriaPrima::get($id);

        // preparo formulario para mostrar ( en este caso con datos de mp )
        $form = new mpForm($this->categorias,$this->unidad_medida,$mp);
        $view_form = $form->renderConParametros();

        // devuelvo html con el formulario (para mostra por ajax)
        if (Request()->ajax()) {
            return $view_form;
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
        $info = $request->validate([
            'nombre' => 'required',
            'unidad_medida_id' => 'required|numeric',
            'categoria_mp_id' => 'required|numeric',
            'cantidad' => 'required'
        ]);


        // actualizo mp
        $mp = MateriaPrima::get($id);
        $mp->nombre = $info['nombre'];
        $mp->unidad_medida_id = $info['unidad_medida_id'];
        $mp->categoria_mp_id = $info['categoria_mp_id'];
        $mp->cantidad = $info['cantidad'];
        $mp->save();

        // recupero registro para devolverlo
        $mp = MateriaPrima::getForList($id);

        if (request()->ajax()) {
            return response()->json($mp);
            //return ["ajax" => $request->ajax()];
        } else {
            return back()->withSuccess('La materia prima se modifico correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mp = MateriaPrima::get($id);
        $mp->estado = 1;
        $mp->save();

        // vuelvo a la vista con mensaje de exito
        return back()->withSuccess('La materia prima se elimino correctamente');
    }

    /*****************************************************************
     * METODOS PARA LA API
     **********************************/

    /**
     * Recuperar las materias primas por API
     */
    public function indexApi(Request $request)
    {
        $page = $request->page ?? 1;

        // recupero materias primas paginando de a 10
        $materias_primas = MateriaPrima::getPaginate(10);

        // preparo datos para enviar
        $datos = [
            'materias_primas' => $materias_primas,
            'categorias' => $this->categorias,
            'unidad_medida' => $this->unidad_medida,
            'page' => $page
        ];

        // devuelvo resultados
        return response()->json($datos);
    }

    /**
     * actualiza una materia prima
     */
    public function updateApi(Request $request,$id) {
        $data = $request->all();

        $info = $request->validate([
            'nombre' => 'required',
            'id_um' => 'required|numeric',
            'id_categoria' => 'required|numeric',
            'cantidad' => 'required'
        ]);

        // actualizo mp
        $mp = MateriaPrima::get($id);
        $mp->nombre = $info['nombre'];
        $mp->unidad_medida_id = $info['id_um'];
        $mp->categoria_mp_id = $info['id_categoria'];
        $mp->cantidad = $info['cantidad'];
        $mp->save();

        // recupero registro para devolverlo
        $mp = MateriaPrima::getForList($id);

        return response()->json($mp);
    }

    /**
     * guarda una nueva materia prima
     */
    public function storeApi(Request $request) {
        // valido datos de entrada
        $info = $request->validate([
            'nombre' => 'required',
            'id_um' => 'required|numeric',
            'id_categoria' => 'required|numeric',
            'cantidad' => 'required'
        ]);

        // preparo la materia prima y guardo
        $mp = new MateriaPrima();
        $mp->nombre = $info['nombre'];
        $mp->unidad_medida_id = $info['id_um'];
        $mp->categoria_mp_id = $info['id_categoria'];
        $mp->cantidad = $info['cantidad'];
        $mp->estado = 0;
        $mp->save();

        return response()->json($mp);
    }

    /**
     * Elimina una materia prima -> cambia estado
     */
    public function destroyApi($id)
    {
        $mp = MateriaPrima::get($id);
        $mp->estado = 1;
        $mp->save();

        // vuelvo a la vista con mensaje de exito
        return response()->json(array('estado' => 1));
    }


}
