<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    protected $table = "usuarios";
    protected $primaryKey = "nick";
    protected $fillable = ["nombre", "correo", "password"];
    protected $hidden = ["password", "remember_token"];
    public $timestamps = false;

    public function gustan() {
        return $this->belongsToMany("App\Usuario", "gustan", "usuario", "imagen");
    }

    public function comentarios() {
        return $this->belongsToMany("App\Imagen", "comentarios", "usuario", "imagen", "comentario")->withPivot("comentario")->withPivot("fecha");
    }

}
