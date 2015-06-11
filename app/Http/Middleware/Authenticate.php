<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\URL;

class Authenticate implements Middleware {

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) {
        if ($this->auth->guest()) {
            return redirect(URL::previous());
        }
        return $next($request);
    }

}
