<?php

namespace App\Http\Requests\Auth\Reset;

use App\Http\Requests\ApiFormRequest;
use App\Models\User\User;

class UpdateRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'password' => ['required','string','min:'. User::$password_length],
            'password_confirmation' => ['required','string','same:password','min:'. User::$password_length]
        ];
    }
}