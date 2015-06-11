/*
 * Piclike
 * JS para hacer interactiva la cuenta de usuario
 * Licencia MIT
 * Copyright (c) 2015 iamas92
 */
$(window).load(function () {
    var alto = $("#wrapper").children().eq(0).height();
    $("#wrapper").css("height", alto + 50);
    // Insertar categoria
    $("#insert-form").hide();
    $("#insert").click(function () {
        $(this).hide();
        $("#insert-form").show();
    });
    $("#insert-cancel").click(function () {
        $("#insert-form").hide();
        $("#insert").show();
        $("#insert-form .error").remove();
        $("#insert-form input").val("").css("border-color", "#0080ff");
    });
    $("#insert-category").click(function (e) {
        $("#insert-form .error").remove();
        $("#insert-form input").css("border-color", "#0080ff");
        if ($("#category").val().length <= 2) {
            e.preventDefault();
            $("#category").css("border-color", "#f77f00");
            $("#category").after("<label class='error last'>Nombre muy corto</label>");
        }
    });
    // Subir imagen
    $("#upload-form").hide();
    $("#upload").click(function () {
        $(this).hide();
        $("#upload-form").show();
    });
    $("#upload-cancel").click(function () {
        $("#upload-form").hide();
        $("#upload").show();
        $("#upload-form .error").remove();
        $("#upload-form input").val("").css("border-color", "#0080ff");
        $("#upload-form output").val("").css("border-color", "#0080ff");
        $("#file").val("");
        $("#path").hide();
        $("#path").val("");
    });
    $("#file").hide();
    $("#file").change(function () {
        $(this).after("<output class='inp-default' id='path'></output>");
        $("#path").val($("#file").val().substr(12));
        $("#name").val($("#file").val().substr(12));
        $("#upload-form .error").remove();
        $("#upload-form input").css("border-color", "#0080ff");
        $("#upload-form output").css("border-color", "#0080ff");
    });
    $("#upload-file").css("display", "block").css("margin", "auto").css("margin-bottom", "10px");
    $("#upload-file").click(function () {
        $("#upload-form .error").remove();
        $("#upload-form input").css("border-color", "#0080ff");
        $("#upload-form output").css("border-color", "#0080ff");
        $("#path").remove();
        $("#file").click();
    });
    $("#upload-image").click(function (e) {
        $("#upload-form .error").remove();
        $("#upload-form input").css("border-color", "#0080ff");
        $("#upload-form output").css("border-color", "#0080ff");
        if ($("#file").val().length == 0) {
            e.preventDefault();
            $("#file").after("<output class='inp-default' id='path'></output>");
            $("#path").hide();
            $("#path").css("border-color", "#f77f00");
            $("#path").after("<label class='error'>Selecciona una imagen</label>");
        }
        else {
            var ext = $("#file").val().split(".").pop().toLowerCase();
            if ($.inArray(ext, ["jpg", "jpeg", "png"]) == -1) {
                e.preventDefault();
                $("#path").css("border-color", "#f77f00");
                $("#path").after("<label class='error'>Formato de imagen no válido</label>");
            }
            else if ($("#name").val().length <= 2) {
                e.preventDefault();
                $("#name").css("border-color", "#f77f00");
                $("#name").after("<label class='error last'>Título muy corto</label>");
            }
            else if ($("#name").val().length > 25) {
                e.preventDefault();
                $("#name").css("border-color", "#f77f00");
                $("#name").after("<label class='error last'>Título muy largo</label>");
            }
        }
    });
    // Modificar
    $("#alter-form").hide();
    $("#alter").click(function () {
        $(this).hide();
        $("#alter-form").show();
    });
    $("#alter-cancel").click(function () {
        $("#alter-form").hide();
        $("#alter").show();
        $("#alter-form .error").remove();
        $("#alter-form input").val("").css("border-color", "#0080ff");
    });
    $("#alter-submit").click(function (e) {
        $("#alter-form .error").remove();
        $("#alter-form input").css("border-color", "#0080ff");
        if ($("#name").val().length <= 2) {
            e.preventDefault();
            $("#name").css("border-color", "#f77f00");
            $("#name").after("<label class='error last'>Nombre muy corto</label>");
        }
        if ($("#name").val().length > 25) {
            e.preventDefault();
            $("#name").css("border-color", "#f77f00");
            $("#name").after("<label class='error last'>Nombre muy largo</label>");
        }
    });
    // Borrar
    $("#delete-form").hide();
    $("#delete").click(function () {
        $(this).hide();
        $("#delete-form").show();
    });
    $("#delete-cancel").click(function () {
        $("#delete-form").hide();
        $("#delete").show();
    });
    // Añadir a categoria
    $("#add-categ-form").hide();
    $("#add-categ").click(function () {
        $(this).hide();
        $("#add-categ-form").show();
    });
    $("#add-categ-cancel").click(function () {
        $("#add-categ-form").hide();
        $("#add-categ").show();
    });
    // Borrar de categoria
    $("#delete-categ-form").hide();
    $("#delete-categ").click(function () {
        $(this).hide();
        $("#delete-categ-form").show();
    });
    $("#delete-categ-cancel").click(function () {
        $("#delete-categ-form").hide();
        $("#delete-categ").show();
    });
    // Muestra de retroalimentación
    window.setTimeout(function () {
        $("#message").remove();
    }, 5000);
    // Crear comentario
    $("#comment-submit").click(function(e) {
        if ($("#comment-inp").val().length < 2) {
            e.preventDefault();
            $("#comment-inp").css("border-color", "#f77f00");
            $("#comment-inp").after("<label class='error last'>Comentario muy corto</label>");
            var alto = $("#wrapper").children().eq(0).height();
            $("#wrapper").css("height", alto + 50);
        }
    });
});