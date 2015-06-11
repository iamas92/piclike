<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

    protected $table = "categorias";
    public $timestamps = false;

    public function imagenes() {
        return $this->belongsToMany("App\Imagen", "pertenecen", "categoria", "imagen");
    }

    public function usuario() {
        return $this->belongsTo("Usuario", "apodo");
    }

}
