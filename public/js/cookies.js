/*
 * Piclike
 * JS para mostrar el aviso de uso de cookies
 * Licencia MIT
 * Copyright (c) 2015 iamas92
 */
$(document).ready(function () {
    window.setTimeout(function () {
        $("#cookies").remove();
        $.cookie("cookies", "1");
    }, 10000);
    if ($.cookie("cookies") === "1") {
        $('#cookies').remove();
    }
});