<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class UpdateUserValidator extends Validator
{
    protected $rules = [
        'first_name' => 'min:2|max:32',
        'last_name'  => 'min:2|max:32',
        'username'   => 'min:3|max:32|unique:users',
        'email'      => 'email|unique:users',
        'password'   => 'min:6|max:32',
    ];
}