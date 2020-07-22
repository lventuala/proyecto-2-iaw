<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::getUsuarios(Auth::user()->id);
        return view('usuarios',compact('usuarios'));
    }

    /**
     * Activa el usuario pasado como parametro (cambia estado a 0)
     */
    public function activar($id) {
        User::updateEstado($id,0);
        return back()->withSuccess('Usuario activado');
    }

    /**
     * Desactiva el usuario pasado como parametro (cambia estado a 1)
     */
    public function desactivar($id) {
        User::updateEstado($id,1);
        return back()->withSuccess('Usuario desactivado');
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
        //
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

    /**
     * METODOS PARA LA API
     */

     /**
      * Recupera un usuario con sus funciones
      */
    public function getUsuarioApi() {
        $user = Request()->user();
        $res = User::getUsuarioRoles($user->id);
        $usuario_final = array();

        // seteo roles del usuario
        $roles = array(
            'admin' => false,
            'base' => false,
            'usuario' => false
        );

        foreach ($res as $r) {
            if($usuario_final == null) {
                $usuario_final['nombre'] = $user->nombre;
                $usuario_final['email'] = $user->email;
                $usuario_final['estado'] = $user->estado;
            }

            $roles[$r->rol] = true;
        }

        // seteo funciones de acuerdo al rol que tenga el usuario
        $funciones = array();
        $funciones [] = array('nombre' => 'Home', 'url' => '/home');
        $url_default = "";

        if ($roles['admin']) {
            $funciones [] = array('nombre' => 'Usuarios', 'url' => '/usuarios');
            $funciones [] = array('nombre' => 'Productos', 'url' => '/productos');
            $funciones [] = array('nombre' => 'Materias Primas', 'url' => '/materias-primas');
            $url_default = "/productos";
        } else if ($roles['base']) {
            $funciones [] = array('nombre' => 'Productos', 'url' => '/productos');
            $funciones [] = array('nombre' => 'Materias Primas', 'url' => '/materias-primas');
            $url_default = "/productos";
        } else if ($roles['usuario']) {
            $funciones [] = array('nombre' => 'Generar Pedido', 'url' => '/generar-pedido');
            $funciones [] = array('nombre' => 'Pedidos Generados', 'url' => '/pedidos-generados');
            $url_default = "/generar-pedido";
        }

        $usuario_final['roles'] = $roles;
        $usuario_final['funciones'] = $funciones;
        $usuario_final['url_default'] = $url_default;

        return response()->json(array(
            'usuario' => $usuario_final,
            'error' => false,
        ));
    }

    /**
     * Recupera el listado de usuarios
     */
    public function indexApi()
    {
        $usuarios = User::getUsuarios(Auth::user()->id);
        return response()->json(array("usuarios" => $usuarios));
    }

    /**
     * Activa el usuario pasado como parametro (cambia estado a 0)
     */
    public function activarApi($id) {
        User::updateEstado($id,0);
        $usuario = User::getUsuario($id);
        return response()->json(array("usuario" => $usuario));
    }

    /**
     * Desactiva el usuario pasado como parametro (cambia estado a 1)
     */
    public function desactivarApi($id) {
        User::updateEstado($id,1);
        $usuario = User::getUsuario($id);
        return response()->json(array("usuario" => $usuario));
    }
}
