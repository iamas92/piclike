<!doctype html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
        <meta name="application-name" content="Piclike">
        <meta name="description" content="Red social para compartir imágenes">
        <meta name="keywords" content="piclike, imágenes, fotos, compartir, social">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="_search" content="{{ url() }}">
        <link rel="author" type="text/plain" href="{{ URL("/humans.txt") }}">
        <link rel="icon" type="image/png" href="{{ URL("/img/favicon.png") }}">
        <link rel="stylesheet" type="text/css" href="{{ URL("css/main.css") }}">
        <script src="{{ URL("js/lib/jquery-2.1.4.min.js") }}">
        </script>
        <script src="{{ URL("js/lib/jquery.cookie.min.js") }}">
        </script>
        <script src="{{ URL("js/cookies.js") }}">
        </script>
        <title>
            {{ $titulo }}
        </title>
    </head>
    <body>
        @include("header")
        <section id="main">
            @yield("content")
        </section>
        @include("footer")
    </body>
</html>