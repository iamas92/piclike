<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DateTime;
use App\Categoria;
use App\Imagen;

class Manage extends Controller {

    protected $usuario;
    protected $imagen;
    protected $categoria;

    public function __construct(Imagen $imagen, Categoria $categoria) {
        $this->usuario = Auth::user();
        $this->imagen = $imagen;
        $this->categoria = $categoria;
    }

    public function postCategory(Request $request) {
        $categoria = new $this->categoria;
        $categoria->nombre = $request->get("category");
        $categoria->usuario = $this->usuario->nick;
        $categoria->save();
        Session::flash("aviso", "Categoría creada");
        return redirect("/user/{$this->usuario->nick}");
    }

    public function postDeleteCategory(Request $request) {
        $categoria = Categoria::find($request->get("category"));
        Categoria::where("id", "=", $categoria->id)->delete();
        Session::flash("aviso", "Categoría borrada");
        return redirect("/user/{$this->usuario->nick}");
    }

    public function postPicture(Request $request) {
        $imagen = new $this->imagen;
        $imagen->titulo = $request->get("name");
        $imagen->usuario = $this->usuario->nick;
        date_default_timezone_set("Europe/Madrid");
        $fecha = new DateTime();
        $nombre = $fecha->format("dmyHis");
        $extension = "." . $request->file("file")->getClientOriginalExtension();
        $extension = strtolower($extension);
        $request->file("file")->move(public_path() . "/img/pictures/" . $this->usuario->nick, $nombre . $extension);
        $imagen->ruta = "/img/pictures/" . $this->usuario->nick . "/" . $nombre . $extension;
        $imagen->save();
        Session::flash("aviso", "Imagen subida");
        return redirect("/user/{$this->usuario->nick}");
    }

    public function postDeletePicture(Request $request) {
        $imagen = Imagen::find($request->get("image"));
        Imagen::where("id", "=", $imagen->id)->delete();
        File::delete(public_path() . $imagen->ruta);
        Session::flash("aviso", "Imagen borrada");
        return redirect("/user/{$this->usuario->nick}");
    }

    public function postRenamePicture(Request $request) {
        $imagen = Imagen::find($request->get("image"));
        $titulo = $request->get("name");
        Imagen::where("id", "=", $imagen->id)->update(array("titulo" => $titulo));
        Session::flash("aviso", "Imagen modificada");
        return redirect("/picture/{$imagen->id}");
    }

    public function postRenameCategory(Request $request) {
        $categoria = Categoria::find($request->get("category"));
        $nombre = $request->get("name");
        Categoria::where("id", "=", $categoria->id)->update(array("nombre" => $nombre));
        Session::flash("aviso", "Categoría modificada");
        return redirect("/category/{$categoria->id}");
    }

    public function postCategPicture(Request $request) {
        $imagen = Imagen::find($request->get("image"));
        $categoria = Categoria::find($request->get("category"));
        $imagen->categorias()->attach($categoria->id);
        Session::flash("aviso", "Imagen añadida a " . $categoria->nombre);
        return redirect("/picture/{$imagen->id}");
    }

    public function postCategDeletePicture(Request $request) {
        $imagen = Imagen::find($request->get("image"));
        $categoria = Categoria::find($request->get("category"));
        $imagen->categorias()->detach($categoria->id);
        Session::flash("aviso", "Imagen quitada de " . $categoria->nombre);
        return redirect("/picture/{$imagen->id}");
    }

}
