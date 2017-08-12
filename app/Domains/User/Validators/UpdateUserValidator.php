<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class UpdateUserValidator extends Validator
{
    protected $rules = [
        'name'          => 'string',
        'email'         => 'email|unique:users',
        'phone_primary' => 'numeric',
        'password'      => 'min:6|max:32',
    ];
}