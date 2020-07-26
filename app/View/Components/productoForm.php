<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductoForm extends Component
{
    public $materias_primas;
    public $producto;
    public $producto_mp;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($materiasPrimas,$producto=null,$producto_mp = null)
    {
        $this->materias_primas = $materiasPrimas;
        $this->producto = $producto;
        $this->producto_mp = $producto_mp;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.producto-form');
    }

    public function renderConParametros()
    {
        return view(
            'components.producto-form',
            [
                'materias_primas' => $this->materias_primas,
                'producto' => $this->producto,
                'producto_mp' => $this->producto_mp
            ]);
    }
}
