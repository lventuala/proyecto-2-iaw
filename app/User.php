<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $table = 'usuario';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsuarios($not_id = 0) {
        return User::where('id','!=',$not_id)->get();
    }

    public static function get($id) {
        return User::where('id',$id)->get()->first();
    }

    public static function updateEstado($id,$estado) {
        $usuario = User::get($id);
        $usuario->estado = $estado;
        $usuario->save();
    }


    public function roles() {
        return $this
            ->belongsToMany('App\Rol', 'rol_usuario', 'usuario_id', 'rol_id')
            ->withTimestamps();
    }

    /**
     * Actualizo token para uso por API
     */
    public function updateToken() {
        $new_token = Str::random(80);
        $this->api_token = $new_token;
        $this->save();
        return $new_token;
    }

    public function hasRol($rol) {
        if ($this->roles()->where('nombre', $rol)->first()) {
            return true;
        }

        return false;
    }

}
