<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;

class Social extends Controller {

    protected $usuario;

    public function __construct() {
        $this->usuario = Auth::user();
    }

    public function like($imagen) {
        $this->usuario->gustan()->attach($imagen);
        return redirect("/picture/{$imagen}");
    }

    public function dislike($imagen) {
        $this->usuario->gustan()->detach($imagen);
        return redirect("/picture/{$imagen}");
    }

    public function addComment(Request $request, $imagen) {
        date_default_timezone_set("Europe/Madrid");
        $fecha = new DateTime();
        $this->usuario->comentarios()->attach($imagen, ["comentario" => $request->get("comment-inp"), "fecha" => $fecha->format("dmyHis")]);
        return redirect("/picture/{$imagen}");
    }

    public function deleteComment($fecha) {
        $imagen = \DB::table("comentarios")->where("fecha", "=", $fecha)->first();
        \DB::table("comentarios")->where("fecha", "=", $fecha)->delete();
        return redirect("/picture/{$imagen->imagen}");
    }

}
