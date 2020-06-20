<?php

namespace App\View\Components;

use Illuminate\View\Component;

class productoForm extends Component
{
    public $materias_primas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($materiasPrimas)
    {
        $this->materias_primas = $materiasPrimas;
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
}
