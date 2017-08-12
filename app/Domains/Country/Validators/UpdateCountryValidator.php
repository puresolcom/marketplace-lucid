<?php

namespace App\Domains\Country\Validators;

use Awok\Validation\Validator;

class UpdateCountryValidator extends Validator
{
    protected $rules = [
        'slug' => 'alpha_dash|unique:countries',
    ];
}