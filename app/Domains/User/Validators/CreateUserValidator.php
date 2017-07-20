<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class CreateUserValidator extends Validator
{
    protected $rules = [
        'first_name' => 'required|min:2|max:32',
        'last_name'  => 'required|min:2|max:32',
        'username'   => 'required|min:3|max:32|unique:users',
        'email'      => 'required|email|unique:users',
        'password'   => 'required|min:6|max:32',
    ];
}