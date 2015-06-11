<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model {

    protected $table = "imagenes";
    public $timestamps = false;

    public function categorias() {
        return $this->belongsToMany("App\Categoria", "pertenecen", "imagen", "categoria");
    }

    public function usuario() {
        return $this->belongsTo("Usuario", "apodo");
    }

    public function gustan() {
        return $this->belongsToMany("App\Usuario", "gustan", "imagen", "usuario");
    }

    public function comentarios() {
        return $this->belongsToMany("App\Usuario", "comentarios", "imagen", "usuario", "comentario")->withPivot("comentario")->withPivot("fecha");
    }

}
