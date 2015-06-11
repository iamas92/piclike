/*
 * Piclike
 * JS para validar el formulario de registro
 * Licencia MIT
 * Copyright (c) 2015 iamas92
 */
$(window).load(function () {
    $("#register").click(function (e) {
        $(".inp-default").css("border-color", "#0080ff");
        $(".error").remove();
        var sw, expReg, cumpleExpReg;
        sw = true;
        expReg = new RegExp("^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$");
        cumpleExpReg = expReg.exec($("#email").val());
        if (cumpleExpReg === null) {
            e.preventDefault();
            sw = false;
            $("#email").css("border-color", "#f77f00");
            $("#email").after("<label class='error'>Correo no válido</label>");
        }
        if ($("#nick").val().length < 3) {
            e.preventDefault();
            $("#nick").css("border-color", "#f77f00");
            $("#nick").after("<label class='error'>Apodo muy corto</label>");
        }
        if ($("#name").val().length < 3) {
            e.preventDefault();
            sw = false;
            $("#name").css("border-color", "#f77f00");
            $("#name").after("<label class='error'>Nombre muy corto</label>");
        }
        if ($("#password").val().length < 6) {
            e.preventDefault();
            sw = false;
            $("#password").css("border-color", "#f77f00");
            $("#password").after("<label class='error'>Contraseña muy corta</label>");
        }
        else {
            if ($("#confirm").val() !== $("#password").val()) {
                e.preventDefault();
                sw = false;
                $("#confirm").css("border-color", "#f77f00");
                $("#confirm").after("<label class='error last'>Las contraseñas no coinciden</label>");
            }
        }
        if (sw) {
            e.preventDefault();
            $.ajax({
                url: "check",
                method: "POST",
                data: {_token: $("meta[name='_token']").attr("content"), nick: $("#nick").val()},
                timeout: 3000
            }).done(function (respuesta) {
                if (respuesta == 0) {
                    $("#nick").css("border-color", "#f77f00");
                    $("#nick").after("<label class='error'>Apodo ya existente</label>");
                }
                else {
                    $("form").submit();
                }
            });
        }
    });
});