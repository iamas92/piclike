@section("header")
<aside id="cookies">
    <p class="center">
        Este sitio web utiliza cookies propias para mejorar la experiencia de navegación. Si continuas navegando, consideramos que aceptas su uso.
    </p>
</aside>
<header>
    <section id="navbar">
        <section id="logo">
            <a href="{{ URL::to("/") }}" id="logo-link">
                <h1>
                    piclike
                </h1>
            </a>
        </section>
        <section id="search">
            <script type="text/javascript" src="{{ URL("js/search.js") }}">
            </script>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="search" id="inp-search" autocomplete="off" placeholder="Buscar usuario o imagen">
        </section>
        <section id="login">
            @if (Auth::check())
            <a href="{{ URL::to("/logout") }}">
                <button type="button" class="btn-primary">
                    Salir
                </button>
            </a>
            <a href="{{ URL::to("/user/".Auth::user()->nick) }}">
                <button type="button" class="btn-default">
                    <img src="{{ URL::to(Auth::user()->imagen) }}" alt="{{ Auth::user()->nombre }}">
                    {{ Auth::user()->nombre }}
                </button>
            </a>
            @else
            <a href="{{ URL::to("/register") }}">
                <button type="button" class="btn-primary">
                    Crear cuenta
                </button>
            </a>
            <a href="{{ URL::to("/login") }}">
                <button type="button" class="btn-default">
                    Entrar
                </button>
            </a>
            @endif
        </section>
    </section>
</header>
@show