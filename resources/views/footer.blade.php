@section("footer")
<footer>
    <section id="links">
        <ul>
            <li>
                <a href="{{ URL::to("/privacy") }}">
                    Política de privacidad
                </a>
            </li>
            <li>
                <a href="{{ URL::to("/terms") }}">
                    Términos del servicio
                </a>
            </li>
            <li>
                <a href="{{ URL::to("/about") }}">
                    Sobre nosotros
                </a>
            </li>
            <li>
                <p>
                    © 2015 Piclike
                </p>
            </li>
        </ul>
    </section>
</footer>
@show