<?php

namespace App\Domains\Role\Validators;

use Awok\Validation\Validator;

class CreateRoleValidator extends Validator
{
    protected $rules = [
        'role' => 'required|alpha_dash|min:3|max:64|unique:roles',
        'name' => 'required|min:3|max:64',
    ];
}