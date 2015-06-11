@extends("layout")
@section("content")
<script type="text/javascript" src="{{ URL("js/validator.js") }}">
</script>
<section class="form">
    <h1 class="center">
        {{ $titulo }}
    </h1>
    <form class="form-default" action="{{ URL::to("/register") }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="nick">
            Apodo
        </label>
        <input type="text" class="inp-default" id="nick" name="nick">
        <label for="email">
            Correo electrónico
        </label>
        <input type="email" class="inp-default" id="email" name="email">
        <label for="name">
            Nombre
        </label>
        <input type="text" class="inp-default" id="name" name="name">
        <label for="password">
            Contraseña
        </label>
        <input type="password" class="inp-default" id="password" name="password">
        <label for="confirm">
            Confirmar contraseña
        </label>
        <input type="password" class="inp-default last" id="confirm" name="confirm">
        <button type="submit" class="btn-primary last" id="register">
            Crear cuenta
        </button>
    </form>
</section>
@stop