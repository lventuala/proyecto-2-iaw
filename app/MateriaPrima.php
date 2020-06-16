<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table = 'materia_prima';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','unidad_medida_id','categoria_mp_id', 'cantidad', 'estado'
    ];

    public static function get($id) {
        return MateriaPrima::where('id',$id)->get()->first();
    }

    public static function getForList($id) {
        return MateriaPrima::join('unidad_medida','unidad_medida.id', '=', 'unidad_medida_id')
        ->join('categoria_mp','categoria_mp.id', '=', 'categoria_mp_id')
        ->select('materia_prima.id','materia_prima.nombre', 'cantidad', 'descripcion as uni_medida', 'categoria_mp.nombre as categoria')
        ->where('materia_prima.id',$id)->get()->first();
    }

    public static function getPaginate($cant) {
        return MateriaPrima::
        join('unidad_medida','unidad_medida.id', '=', 'unidad_medida_id')
        ->join('categoria_mp','categoria_mp.id', '=', 'categoria_mp_id')
        ->select('materia_prima.id','materia_prima.nombre', 'cantidad', 'descripcion as uni_medida', 'categoria_mp.nombre as categoria')
        ->where('materia_prima.estado','0')
        ->orderBy('materia_prima.nombre')
        ->paginate($cant);
    }

    public function unidadMedida() {
        return $this->hasOne(UnidadMedida::class);
    }

    public function categoriaMP() {
        return $this->hasOne(CategoriaMP::class);
    }
}
