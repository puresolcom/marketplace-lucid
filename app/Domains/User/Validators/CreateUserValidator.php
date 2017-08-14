<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class CreateUserValidator extends Validator
{
    protected $rules = [
        'name'          => 'required|string',
        'email'         => 'required|email|unique:users',
        'phone_primary' => 'required|numeric',
        'password'      => 'required|min:6|max:32',
        'active'        => 'boolean'
    ];
}