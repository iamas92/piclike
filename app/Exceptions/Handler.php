<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {

    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    public function report(Exception $e) {
        return parent::report($e);
    }

    public function render($request, Exception $e) {
        if ($e instanceof NotFoundHttpException) {
            return response()->view("errors/404", array("titulo" => "Página no encontrada"), 404);
        }
        return parent::render($request, $e);
    }

}
