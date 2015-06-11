@extends("layout")
@section("content")
<script type="text/javascript" src="{{ URL("js/interactive.js") }}">
</script>
<section id="wrapper">
    <section id="photo-wrapper">
        <section id="photo">
            <figure>
                <img src="{{ URL::to($imagen->ruta) }}" alt="{{ $imagen->titulo }}">
            </figure>
        </section>
        <section id="title">
            <h1>
                {{ $imagen->titulo }}
            </h1>
        </section>
        @if (Auth::check())
        <section id="social">
            @if ($gustaUsuario == null)
            <a href="{{ URL::to("/like/".$imagen->id) }}">
                <button type="button" class="btn-primary">
                    Me gusta
                </button>
            </a>
            @else
            <p class="right" id="like">
                {{ $gusta }} me gusta
            </p>
            <a href="{{ URL::to("/dislike/".$imagen->id) }}">
                <button type="button" class="btn-default">
                    Ya no me gusta
                </button>
            </a>
            @endif
        </section>
        @endif
        <section id="comments-wrapper">
            @if ($comentarios->isEmpty())
            <p class="center last">
                Todavía no hay comentarios en esta imagen.
            </p>
            @else
            <h2>
                Comentarios
            </h2>
            @foreach ($comentarios as $comentario)
            <section class="comment">
                <figure>
                    <img src="{{ URL::to($comentario->imagen) }}" alt="{{ $comentario->nombre }}">
                </figure>
                <a href="{{ URL::to("/user/".$comentario->nick) }}">
                    {{ $comentario->nombre }}
                </a>
                @if (Auth::check() && Auth::user()->nick == $comentario->nick)
                <a href="{{ URL::to("/delete-comment/".$comentario->pivot->fecha) }}" class="comment-delete">
                    Borrar comentario
                </a>
                @endif
                <p>
                    {{ $comentario->pivot->comentario }}
                </p>
            </section>
            @endforeach
            @endif
            @if (Auth::check())
            <section id="comment-add">
                <form class="form-comment" method="post" action="{{ URL::to("/insert-comment/".$imagen->id) }}" id="add-comment-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="comment-inp">
                        Añadir comentario
                    </label>
                    <textarea class="inp-default last" id="comment-inp" name="comment-inp"></textarea>
                    <button type="submit" class="btn-primary last" id="comment-submit">
                        Enviar comentario
                    </button>
                </form>
            </section>
            @endif
        </section>
    </section>
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
        @if (!$imagen->categorias->isEmpty())
        <section id="categories">
            <h2 class="center last">
                Categorías
            </h2>
            @foreach ($imagen->categorias as $categoria)
            <a href="{{ URL::to("category/".$categoria->id) }}">
                {{ $categoria->nombre }}
            </a>
            @endforeach
        </section>
        @endif
        @if (Auth::check() && Auth::user()->nick == $usuario->nick)
        @if ($categoriasNoImagen != null)
        <section class="manage">
            <button type="button" class="btn-default profile" id="add-categ">
                Agregar a categoría
            </button>
            <form class="form-default" action="{{ URL::to("/picture-category") }}" method="post" id="add-categ-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="image" value="{{ $imagen->id }}">
                <label for="category">
                    Agregar a categoría
                </label>
                <select class="inp-default last" id="category" name="category">
                    @foreach ($categoriasNoImagen[0] as $categoria)
                    <option value="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>
                <button type="button" class="btn-default" id="add-categ-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Agregar
                </button>
            </form>
        </section>
        @else
        <section class="manage">
            <button type="button" class="btn-default profile" id="add-categ">
                Agregar a categoría
            </button>
            <form class="form-default" action="{{ URL::to("/picture-category") }}" method="post" id="add-categ-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="image" value="{{ $imagen->id }}">
                <label for="category">
                    Agregar a categoría
                </label>
                <select class="inp-default last" id="category" name="category">
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>
                <button type="button" class="btn-default" id="add-categ-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Agregar
                </button>
            </form>
        </section>
        @endif
        @if (!$imagen->categorias->isEmpty())
        <section class="manage">
            <button type="button" class="btn-default profile" id="delete-categ">
                Quitar de categoría
            </button>
            <form class="form-default" action="{{ URL::to("/picture-category-delete") }}" method="post" id="delete-categ-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="image" value="{{ $imagen->id }}">
                <label for="category">
                    Quitar de categoría
                </label>
                <select class="inp-default last" id="category" name="category">
                    @foreach ($imagen->categorias as $categoria)
                    <option value="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>
                <button type="button" class="btn-default" id="delete-categ-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Quitar
                </button>
            </form>
        </section>
        @endif
        <section class="manage">
            <button type="button" class="btn-default profile" id="alter">
                Alterar imagen
            </button>
            <form class="form-default" action="{{ URL::to("/alter-picture") }}" method="post" id="alter-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="image" value="{{ $imagen->id }}">
                <label for="name">
                    Nuevo título
                </label>
                <input type="text" class="inp-default last" id="name" name="name">
                <button type="button" class="btn-default" id="alter-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary" id="alter-submit">
                    Alterar imagen
                </button>
            </form>
        </section>
        <section class="manage">
            <button type="button" class="btn-default profile" id="delete">
                ¿Borrar imagen?
            </button>
            <form class="form-default" action="{{ URL::to("/delete-picture") }}" method="post" id="delete-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="image" value="{{ $imagen->id }}">
                <button type="button" class="btn-default" id="delete-cancel">
                    Cerrar
                </button>
                <button type="submit" class="btn-primary">
                    Borrar imagen
                </button>
            </form>
        </section>
        @endif
    </section>
</section>
@stop