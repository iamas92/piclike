@extends("layout")
@section("content")
<h1 class="center last">
    {{ $titulo }}
</h1>
<p class="center last">
    Lo sentimos. La página que buscas no existe o ha sido borrada.
</p>
<img class="centered" src="{{ URL::to("/img/404.png") }}" alt="{{ $titulo }}">
@stop