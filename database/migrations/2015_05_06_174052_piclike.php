<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Piclike extends Migration {

    public function up() {
        Schema::create("usuarios", function(Blueprint $table) {
            $table->string("nick", 64)->primary();
            $table->string("nombre", 64);
            $table->string("correo", 64)->unique();
            $table->string("password", 100);
            $table->string("imagen")->nullable();
            $table->rememberToken();
        });
        Schema::create("categorias", function(Blueprint $table) {
            $table->increments("id");
            $table->string("nombre", 64);
            $table->string("usuario", 64);
            $table->foreign("usuario")->references("nick")->on("usuarios")->onDelete("cascade")->onUpdate("cascade");
        });
        Schema::create("imagenes", function(Blueprint $table) {
            $table->increments("id");
            $table->string("titulo", 64);
            $table->string("usuario", 64);
            $table->foreign("usuario")->references("nick")->on("usuarios")->onDelete("cascade")->onUpdate("cascade");
            $table->string("ruta");
        });
        Schema::create("comentarios", function(Blueprint $table) {
            $table->string("usuario");
            $table->integer("imagen")->unsigned();
            $table->string("fecha", 12);
            $table->primary(array("usuario", "imagen", "fecha"));
            $table->string("comentario");
            $table->foreign("usuario")->references("nick")->on("usuarios")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("imagen")->references("id")->on("imagenes")->onDelete("cascade")->onUpdate("cascade");
        });
        Schema::create("gustan", function(Blueprint $table) {
            $table->string("usuario");
            $table->integer("imagen")->unsigned();
            $table->primary(array("usuario", "imagen"));
            $table->foreign("usuario")->references("nick")->on("usuarios")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("imagen")->references("id")->on("imagenes")->onDelete("cascade")->onUpdate("cascade");
        });
        Schema::create("pertenecen", function(Blueprint $table) {
            $table->integer("categoria")->unsigned();
            $table->integer("imagen")->unsigned();
            $table->primary(array("categoria", "imagen"));
            $table->foreign("categoria")->references("id")->on("categorias")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("imagen")->references("id")->on("imagenes")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    public function down() {
        Schema::dropIfExists("comentarios");
        Schema::dropIfExists("gustan");
        Schema::dropIfExists("pertenecen");
        Schema::dropIfExists("categorias");
        Schema::dropIfExists("imagenes");
        Schema::dropIfExists("usuarios");
    }

}
