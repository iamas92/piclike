/*
 * Piclike
 * JS para validar los formularios de modificación
 * Licencia MIT
 * Copyright (c) 2015 iamas92
 */
$(window).load(function () {
    // Cambiar cuenta
    $("#account-submit").click(function (e) {
        $("#account-form .inp-default").css("border-color", "#0080ff");
        $(".account-error").remove();
        var expReg, cumpleExpReg;
        expReg = new RegExp("^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$");
        cumpleExpReg = expReg.exec($("#email").val());
        if (cumpleExpReg === null) {
            e.preventDefault();
            $("#email").css("border-color", "#f77f00");
            $("#email").after("<label class='error account-error'>Correo no válido</label>");
        }
        if ($("#name").val().length < 3) {
            e.preventDefault();
            $("#name").css("border-color", "#f77f00");
            $("#name").after("<label class='error last account-error'>Nombre muy corto</label>");
        }
    });
    // Cambiar contraseña
    $("#password-submit").click(function (e) {
        $("#password-form .inp-default").css("border-color", "#0080ff");
        $(".password-error").remove();
        if ($("#password").val().length < 6) {
            e.preventDefault();
            $("#password").css("border-color", "#f77f00");
            $("#password").after("<label class='error password-error'>Contraseña muy corta</label>");
        }
        else {
            if ($("#confirm").val() !== $("#password").val()) {
                e.preventDefault();
                $("#confirm").css("border-color", "#f77f00");
                $("#confirm").after("<label class='error last password-error'>Las contraseñas no coinciden</label>");
            }
        }
    });
    // Cambiar imagen
    $("#file").hide();
    $("#file").change(function () {
        $(this).after("<output class='inp-default last' id='path'></output>");
        $("#path").val($("#file").val().substr(12));
        $("#name").val($("#file").val().substr(12));
        $("#upload-form .error").remove();
        $("#upload-form output").css("border-color", "#0080ff");
    });
    $("#upload-file").css("display", "block").css("margin", "auto").css("margin-bottom", "10px");
    $("#upload-file").click(function () {
        $("#upload-form .error").remove();
        $("#upload-form output").css("border-color", "#0080ff");
        $("#path").remove();
        $("#file").click();
    });
    $("#upload-image").click(function (e) {
        $("#upload-form .error").remove();
        $("#upload-form output").css("border-color", "#0080ff");
        if ($("#file").val().length == 0) {
            e.preventDefault();
            $("#file").after("<output class='inp-default last' id='path'></output>");
            $("#path").hide();
            $("#path").css("border-color", "#f77f00");
            $("#path").after("<label class='error last'>Selecciona una imagen</label>");
        }
        else {
            var ext = $("#file").val().split(".").pop().toLowerCase();
            if ($.inArray(ext, ["jpg", "jpeg", "png"]) == -1) {
                e.preventDefault();
                $("#path").css("border-color", "#f77f00");
                $("#path").after("<label class='error last'>Formato de imagen no válido</label>");
            }
        }
    });
});