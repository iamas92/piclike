<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    public function rules() {
        return [
            "nick" => "required",
            "password" => "required"
        ];
    }

    public function authorize() {
        return true;
    }

}
