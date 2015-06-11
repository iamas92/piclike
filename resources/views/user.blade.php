@extends("layout")
@section("content")
<script type="text/javascript" src="{{ URL("js/interactive.js") }}">
</script>
<section id="wrapper">
    @if ($imagenes->isEmpty())
    <section id="photos-empty">
        <p class="center">
            Todavía no hay imágenes
        </p>
    </section>
    @else
    <section id="photos-content">
        @foreach ($imagenes as $imagen)
        <figure>
            <a href="{{ URL::to("/picture/".$imagen->id) }}">
                <img src="{{ URL::to($imagen->ruta) }}" alt="{{ $imagen->titulo }}" title="{{ $imagen->titulo }}">
            </a>
        </figure>
        @endforeach
    </section>
    @endif
    <section id="info-wrapper">
        @if (Session::has("aviso"))
        <section id="message">
            <label class="center">
                {{ Session::get("aviso") }}
            </label>
        </section>
        @endif
        <section id="user">
            <figure>
                <img src="{{ URL::to($usuario->imagen) }}" alt="{{ $usuario->nombre }}">
            </figure>
            <a href="{{ URL::to("/user/".$usuario->nick) }}">
                {{ $usuario->nombre }}
            </a>
            <p>
                {{ '@'.$usuario->nick }}
            </p>
            @if (Auth::check() && Auth::user()->nick == $usuario->nick)
            <a href="{{ URL::to("/alter") }}">
                Modificar cuenta
            </a>
            @endif
        </section>
        @if (!$categorias->isEmpty())
        <section id="categories">
            <h2 class="center last">
                Categorías
            </h2>
            @foreach ($categorias as $categoria)
            <a href="{{ URL::to("category/".$categoria->id) }}">
                {{ $categoria->nombre }}
            </a>
            @endforeach
        </section>
        @else
        @if (Auth::check() && Auth::user()->nick == $usuario->nick)
        <section id="categories">
            <h2 class="center last">
                Categorías
            </h2>
            <p class="center">
                No has creado ninguna categoría.
            </p>
        </section>
        @endif
        @endif
        @if (Auth::check() && Auth::user()->nick == $usuario->nick)
        <section class="manage">
            <button type="button" class="btn-default profile" id="insert">
                Crear categoría
            </button>
            <form class="form-default" action="{{ URL::to("/insert-category") }}" method="post" id="insert-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="category">
                    Nombre
                </label>
                <input type="text" class="inp-default last" id="category" name="category">
                <button type="button" class="btn-default" id="insert-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary" id="insert-category">
                    Crear categoría
                </button>
            </form>
        </section>
        <section class="manage">
            <button type="button" class="btn-default profile" id="upload">
                Subir imagen
            </button>
            <form class="form-default" action="{{ URL::to("/upload-picture") }}" method="post" id="upload-form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="button" class="btn-default" id="upload-file">
                    Elegir imagen
                </button>
                <label>
                    Tamaño máximo: 30 MB
                </label>
                <input type="file" id="file" name="file">
                <label for="name">
                    Título
                </label>
                <input type="text" class="inp-default last" id="name" name="name">
                <button type="button" class="btn-default" id="upload-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary" id="upload-image">
                    Subir imagen
                </button>
            </form>
        </section>
        <section class="manage">
            <button type="button" class="btn-default profile" id="delete">
                Darme de baja
            </button>
            <form class="form-default" action="{{ URL::to("/delete-user") }}" method="post" id="delete-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>
                    Esta acción eliminará tu cuenta y tus datos de Piclike
                </label>
                <button type="button" class="btn-default" id="delete-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Darme de baja
                </button>
            </form>
        </section>
        @endif
    </section>
</section>
@stop