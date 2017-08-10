<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class LoginInputValidator extends Validator
{
    protected $rules = [
        'username' => 'required',
        'password' => 'required|min:6|max:32',
    ];
}