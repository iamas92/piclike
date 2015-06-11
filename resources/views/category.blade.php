@extends("layout")
@section("content")
<script type="text/javascript" src="{{ URL("js/interactive.js") }}">
</script>
<section id="wrapper">
    @if ($categoria->imagenes->isEmpty())
    <section id="photos-empty">
        <p class="center">
            Todavía no hay imágenes
        </p>
    </section>
    @else
    <section id="photos-content">
        @foreach ($categoria->imagenes as $imagen)
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
        </section>
        <section id="categories">
            <h2 class="center">
                {{ $categoria->nombre }}
            </h2>
        </section>
        @if (Auth::check() && Auth::user()->nick == $usuario->nick)
        <section class="manage">
            <button type="button" class="btn-default profile" id="alter">
                Alterar categoría
            </button>
            <form class="form-default" action="{{ URL::to("/alter-category") }}" method="post" id="alter-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="category" value="{{ $categoria->id }}">
                <label for="name">
                    Nuevo nombre
                </label>
                <input type="text" class="inp-default last" id="name" name="name">
                <button type="button" class="btn-default" id="alter-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary" id="alter-submit">
                    Alterar categoría
                </button>
            </form>
        </section>
        <section class="manage">
            <button type="button" class="btn-default profile" id="delete">
                ¿Borrar categoría?
            </button>
            <form class="form-default" action="{{ URL::to("/delete-category") }}" method="post" id="delete-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="category" value="{{ $categoria->id }}">
                <button type="button" class="btn-default" id="delete-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Borrar categoría
                </button>
            </form>
        </section>
        @endif
    </section>
</section>
@stop