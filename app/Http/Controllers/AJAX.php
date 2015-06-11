<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Imagen;

class AJAX extends Controller {

    public function checkNick(Request $request) {
        $nick = $request->get("nick");
        $usuario = Usuario::find($nick);
        if ($usuario != null) {
            $respuesta = 0;
        } else {
            $respuesta = 1;
        }
        return $respuesta;
    }

    public function search(Request $request) {
        $busqueda = $request->get("search");
        $usuarios = Usuario::where("nick", "like", "%$busqueda%")->take(8)->get();
        $imagenes = Imagen::where("titulo", "like", "%$busqueda%")->take(8)->get();
        $respuesta = [];
        foreach ($usuarios as $usuario) {
            array_push($respuesta, array($usuario->nick));
        }
        foreach ($imagenes as $imagen) {
            array_push($respuesta, array($imagen->id, $imagen->titulo));
        }
        return $respuesta;
    }

}
