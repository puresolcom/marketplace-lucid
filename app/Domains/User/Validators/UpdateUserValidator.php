<?php

namespace App\Domains\User\Validators;

use Awok\Validation\Validator;

class UpdateUserValidator extends Validator
{
    protected $rules = [
        /** @todo Add some rules bellow here is one example */
        // 'email' => 'required|email|unique.users',
    ];
}