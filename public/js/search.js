/*
 * Piclike
 * JS para la caja de búsqueda
 * Licencia MIT
 * Copyright (c) 2015 iamas92
 */
$(window).load(function () {
    var url = $("meta[name='_search']").attr("content");
    $("#search").append("<section id='results'></section>");
    $("#results").hide();
    $("#inp-search").keyup(function () {
        if ($(this).val().length > 2) {
            $.ajax({
                url: url + "/search",
                method: "POST",
                data: {_token: $("meta[name='_token']").attr("content"), search: $(this).val()},
                timeout: 3000
            }).done(function (respuesta) {
                $("#results").children().remove();
                $("#results").show();
                if (respuesta.length == 0) {
                    $("#results").append("<a href='#'>No hay datos</a>");
                }
                else {
                    for (var i in respuesta) {
                        if (respuesta[i].length == 2) {
                            $("#results").append("<a href='" + url + "/picture/" + respuesta[i][0] + "'>" + respuesta[i][1] + "</a>");
                            $("#results").append("<p>Imagen</p>");
                        }
                        else {
                            $("#results").append("<a href='" + url + "/user/" + respuesta[i][0] + "'>" + respuesta[i][0] + "</a>");
                            $("#results").append("<p>Usuario</p>");
                        }
                    }
                }
            }).fail(function () {
                $("#results").children().remove();
                $("#results").show();
                $("#results").append("<a href='#'>Error, inténtalo más tarde</a>");
            });
        }
        else {
            $("#results").children().remove();
            $("#results").hide();
        }
    });
    $("#inp-search").click(function () {
        if ($(this).val().length > 2) {
            $("#results").show();
        }
    });
    $("#inp-search").focusout(function () {
        window.setTimeout(function () {
            $('#results').hide();
        }, 100);
    });
});