@extends("layout")
@section("content")
<section class="form">
    <h1 class="center">
        {{ $titulo }}
    </h1>
    <form class="form-default" action="{{ URL::to("/login") }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="nick">
            Apodo
        </label>
        <input type="text" class="inp-default" id="nick" name="nick" value="{{ old("nick") }}">
        <label for="password">
            Contraseña
        </label>
        <input type="password" class="inp-default last" id="password" name="password">
        @if (Session::has("error"))
        <label class="error last">
            {{ Session::get("error") }}
        </label>
        @endif
        <button type="submit" class="btn-primary last">
            Entrar
        </button>
    </form>
</section>
@stop