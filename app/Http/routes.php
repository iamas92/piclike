<?php

Route::get("/", ["uses" => "Show@getIndex"]);

Route::get("/login", ["uses" => "Auth\Authentication@getLogin"]);

Route::post("/login", ["uses" => "Auth\Authentication@postLogin"]);

Route::get("/register", ["uses" => "Auth\Authentication@getRegister"]);

Route::post("/register", ["uses" => "Auth\Authentication@postRegister"]);

Route::get("/logout", ["middleware" => "auth", "uses" => "Auth\Authentication@getLogout"]);

Route::post("check", ["uses" => "AJAX@checkNick"]);

Route::post("/search", ["uses" => "AJAX@search"]);

Route::get("/user/{nick}", ["uses" => "Show@getUser"]);

Route::get("/category/{category}", ["uses" => "Show@getCategory"]);

Route::get("/picture/{picture}", ["uses" => "Show@getPicture"]);

Route::get("/alter", ["middleware" => "auth", "uses" => "Auth\AlterProfile@getAlter"]);

Route::post("/account", ["middleware" => "auth", "uses" => "Auth\AlterProfile@postAccount"]);

Route::post("/password", ["middleware" => "auth", "uses" => "Auth\AlterProfile@postPassword"]);

Route::post("/image", ["middleware" => "auth", "uses" => "Auth\AlterProfile@postImage"]);

Route::post("/insert-category", ["middleware" => "auth", "uses" => "Manage@postCategory"]);

Route::post("/delete-category", ["middleware" => "auth", "uses" => "Manage@postDeleteCategory"]);

Route::post("/upload-picture", ["middleware" => "auth", "uses" => "Manage@postPicture"]);

Route::post("/delete-picture", ["middleware" => "auth", "uses" => "Manage@postDeletePicture"]);

Route::post("/alter-picture", ["middleware" => "auth", "uses" => "Manage@postRenamePicture"]);

Route::post("/alter-category", ["middleware" => "auth", "uses" => "Manage@postRenameCategory"]);

Route::get("/like/{picture}", ["middleware" => "auth", "uses" => "Social@like"]);

Route::get("/dislike/{picture}", ["middleware" => "auth", "uses" => "Social@dislike"]);

Route::post("/picture-category", ["middleware" => "auth", "uses" => "Manage@postCategPicture"]);

Route::post("/picture-category-delete", ["middleware" => "auth", "uses" => "Manage@postCategDeletePicture"]);

Route::post("/delete-user", ["middleware" => "auth", "uses" => "Auth\Authentication@postDelete"]);

Route::post("/insert-comment/{picture}", ["middleware" => "auth", "uses" => "Social@addComment"]);

Route::get("/delete-comment/{fecha}", ["middleware" => "auth", "uses" => "Social@deleteComment"]);

Route::get("/privacy", function () {
    return view("/privacy")->with("titulo", "Politica de privacidad");
});

Route::get("/terms", function () {
    return view("/terms")->with("titulo", "Términos del servicio");
});

Route::get("/about", function () {
    return view("/about")->with("titulo", "Sobre nosotros");
});
