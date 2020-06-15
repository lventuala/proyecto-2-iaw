<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaMP extends Model
{
    protected $table = 'categoria_mp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre','estado',
    ];
}
