<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Usuario;

class DatabaseSeeder extends Seeder {

    public function run() {
        Model::unguard();
        $this->call('UserTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run() {
        date_default_timezone_set("Europe/Madrid");
        Usuario::create(array(
            "nick" => "pruebas",
            "nombre" => "Pruebas",
            "correo" => "pruebas@piclike.es",
            "password" => Hash::make("pruebas"),
            "imagen" => "/img/genuser.png"
        ));
    }

}
