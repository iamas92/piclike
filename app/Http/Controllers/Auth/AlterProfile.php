<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AlterProfile extends Controller {

    protected $auth;
    protected $usuario;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        $this->usuario = Auth::user();
    }

    public function getAlter() {
        return view("/alter")->with("titulo", "Modificar cuenta")->with("usuario", $this->usuario);
    }

    public function postAccount(Request $request) {
        $usuario = $this->usuario;
        $usuario->correo = $request->get("email");
        $usuario->nombre = $request->get("name");
        $usuario->save();
        Session::flash("aviso", "Cuenta modificada");
        return redirect("/user/{$usuario->nick}");
    }

    public function postPassword(Request $request) {
        $usuario = $this->usuario;
        $usuario->password = Hash::make($request->get("password"));
        $usuario->save();
        Session::flash("aviso", "Contraseña modificada");
        return redirect("/user/{$usuario->nick}");
    }

    public function postImage(Request $request) {
        $usuario = $this->usuario;
        $nombre = "image";
        $extension = "." . $request->file("file")->getClientOriginalExtension();
        $extension = strtolower($extension);
        $request->file("file")->move(public_path() . "/img/pictures/" . $this->usuario->nick, $nombre . $extension);
        $usuario->imagen = "/img/pictures/" . $this->usuario->nick . "/" . $nombre . $extension;
        $usuario->save();
        Session::flash("aviso", "Imagen modificada");
        return redirect("/user/{$usuario->nick}");
    }

}
