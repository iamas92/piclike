<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Usuario;

class Authentication extends Controller {

    protected $auth;
    protected $usuario;

    public function __construct(Guard $auth, Usuario $usuario) {
        $this->auth = $auth;
        $this->usuario = $usuario;
    }

    public function getRegister() {
        return view("/register")->with("titulo", "Crear cuenta");
    }

    public function postRegister(Request $request) {
        $usuario = new $this->usuario;
        $usuario->nick = $request->get("nick");
        $usuario->correo = $request->get("email");
        $usuario->nombre = $request->get("name");
        $usuario->password = Hash::make($request->get("password"));
        $usuario->imagen = "/img/genuser.png";
        $usuario->save();
        $this->auth->attempt($request->only("nick", "password"));
        Session::flash("aviso", "Bienvenido a Piclike");
        return redirect("/user/" . $request->get("nick"));
    }

    public function getLogin() {
        return view("/login")->with("titulo", "Entrar");
    }

    public function postLogin(LoginRequest $request) {
        if ($this->auth->attempt($request->only("nick", "password"))) {
            Session::flash("aviso", "Bienvenido de nuevo " . $request->get("nick"));
            return redirect("/user/{$request->get("nick")}");
        }
        Session::flash("error", "Credenciales incorrectas");
        return redirect("/login");
    }

    public function getLogout() {
        $this->auth->logout();
        return redirect("/");
    }

    public function postDelete() {
        Usuario::where("nick", "=", $this->auth->id())->delete();
        File::deleteDirectory(public_path() . "/img/pictures/" . $this->auth->id());
        return redirect("/");
    }

}
