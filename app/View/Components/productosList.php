<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductosList extends Component
{

    public $productos;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productos=[])
    {
        $this->productos = $productos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.productos-list',["productos" => $this->productos]);
    }
}
