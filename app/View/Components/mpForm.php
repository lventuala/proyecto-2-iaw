<?php

namespace App\View\Components;

use Illuminate\View\Component;

class mpForm extends Component
{
    public $categorias;
    public $unidad_medida;
    public $data_mod;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categorias,$unidadMedida,$dataMod=null)
    {
        $this->categorias = $categorias;
        $this->unidad_medida = $unidadMedida;
        $this->data_mod = $dataMod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.mp-form');
    }

    public function renderConParametros()
    {
        return view('components.mp-form',['categorias' =>$this->categorias, 'unidad_medida' => $this->unidad_medida, 'data_mod' => $this->data_mod]);
    }
}
