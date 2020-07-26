<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio() {
        $page = Request()->page ?? 1;
        $productos = Producto::getAll();
        foreach($productos as $p) {
            $p->img = stream_get_contents($p->img);
        }

        return view('inicio',['productos' => $productos]);
    }
}
