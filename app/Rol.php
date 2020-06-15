<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion',
    ];

    public function users() {
        return $this
            ->belongsToMany('App\User', 'rol_usuario', 'rol_id', 'usuario_id')
            ->withTimestamps();
    }
}

