<?php

namespace App\Domains\Role\Validators;

use Awok\Validation\Validator;

class UpdateRoleValidator extends Validator
{
    protected $rules = [
        'role' => 'alpha_dash|min:3|max:64|unique:roles',
        'name' => 'min:3|max:64',
    ];
}