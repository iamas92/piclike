@extends("layout")
@section("content")
<script type="text/javascript" src="{{ URL("js/alter.js") }}">
</script>
<section id="forms">
    <section class="form">
        <h1 class="center">
            Modificar cuenta
        </h1>
        <form class="form-default" action="{{ URL::to("/account") }}" method="post" id="account-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="email">
                Correo electrónico
            </label>
            <input type="email" class="inp-default" id="email" name="email" value="{{ $usuario->correo }}">
            <label for="name">
                Nombre
            </label>
            <input type="text" class="inp-default last" id="name" name="name" value="{{ $usuario->nombre }}">
            <button type="submit" class="btn-primary last" id="account-submit">
                Modificar cuenta
            </button>
        </form>
    </section>
    <section class="form">
        <h1 class="center">
            Modificar contraseña
        </h1>
        <form class="form-default" action="{{ URL::to("/password") }}" method="post" id="password-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="password">
                Contraseña nueva
            </label>
            <input type="password" class="inp-default" id="password" name="password">
            <label for="confirm">
                Confirmar contraseña
            </label>
            <input type="password" class="inp-default last" id="confirm" name="confirm">
            <button type="submit" class="btn-primary last" id="password-submit">
                Modificar contraseña
            </button>
        </form>
    </section>
    <section class="form">
        <h1 class="center last">
            Modificar imagen
        </h1>
        <form class="form-default" action="{{ URL::to("/image") }}" method="post" id="upload-form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="button" class="btn-default" id="upload-file">
                Elegir imagen
            </button>
            <label>
                Tamaño máximo: 30 MB
            </label>
            <input type="file" id="file" name="file">
            <button type="submit" class="btn-primary last" id="upload-image">
                Modificar imagen
            </button>
        </form>
    </section>
</section>
@stop