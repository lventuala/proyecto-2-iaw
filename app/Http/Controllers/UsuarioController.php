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
    public function getUsuarioApi() {
        $user = Request()->user();
        $res = User::getUsuarioRoles($user->id);
        $usuario_final = array();
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

        $usuario_final['roles'] = $roles;

        return response()->json(array(
            'usuario' => $usuario_final,
            'error' => false
        ));
    }
}
