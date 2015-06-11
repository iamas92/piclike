<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\Imagen;
use App\Categoria;

class Show extends Controller {

    public function getUser($nick) {
        $usuario = Usuario::find($nick);
        $imagenes = Imagen::where("usuario", "=", $nick)->get();
        $categorias = Categoria::where("usuario", "=", $nick)->get();
        if (!$usuario) {
            abort(404);
        }
        return view("/user")->with("titulo", "$usuario->nombre")->with("usuario", $usuario)->with("imagenes", $imagenes)->with("categorias", $categorias);
    }

    public function getCategory($category) {
        $categoria = Categoria::find($category);
        if (!$categoria) {
            abort(404);
        }
        $usuario = Usuario::find($categoria->usuario);
        return view("/category")->with("titulo", "$categoria->nombre")->with("usuario", $usuario)->with("categoria", $categoria);
    }

    public function getIndex() {
        $imagenes = Imagen::orderBy("id", "desc")->take(12)->get();
        return view("/index")->with("titulo", "Piclike")->with("imagenes", $imagenes);
    }

    public function getPicture($picture) {
        $imagen = Imagen::find($picture);
        if (!$imagen) {
            abort(404);
        }
        $usuario = Usuario::find($imagen->usuario);
        $categorias = Categoria::where("usuario", "=", $usuario->nick)->get();
        $gusta = $imagen->gustan()->count();
        $comentarios = $imagen->comentarios()->orderBy("fecha", "asc")->get();
        if (Auth::check()) {
            $gustaUsuario = \DB::table("gustan")->where("usuario", "=", Auth::user()->nick)->having("imagen", "=", $imagen->id)->first();
            $auxCategoriasImagen = \DB::table("pertenecen")->where("imagen", "=", $imagen->id)->get();
            $categoriasNoImagen = [];
            foreach ($auxCategoriasImagen as $categoria) {
                $aux = Categoria::where("usuario", "=", $usuario->nick)->having("id", "!=", $categoria->categoria)->get();
                if ($aux != null) {
                    array_push($categoriasNoImagen, $aux);
                }
            }
        } else {
            $gustaUsuario = null;
            $categoriasNoImagen = null;
        }
        return view("/picture")->with("titulo", "$imagen->titulo")->with("usuario", $usuario)->with("imagen", $imagen)->with("categorias", $categorias)->with("gusta", $gusta)->with("categoriasNoImagen", $categoriasNoImagen)->with("gustaUsuario", $gustaUsuario)->with("comentarios", $comentarios);
    }

}
