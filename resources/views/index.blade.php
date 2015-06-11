@extends("layout")
@section("content")
<section id="wrapper">
    <h1 class="center">
        La red social de las imágenes
    </h1>
    <section class="wide">
        @foreach ($imagenes as $imagen)
        <figure>
            <a href="{{ URL::to("/picture/".$imagen->id) }}">
                <img src="{{ URL::to($imagen->ruta) }}" alt="{{ $imagen->titulo }}" title="{{ $imagen->titulo }}">
            </a>
        </figure>
        @endforeach
    </section>
</section>
@stop