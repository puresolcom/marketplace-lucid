<?php

namespace App\Domains\Country\Validators;

use Awok\Validation\Validator;

class CreateCountryValidator extends Validator
{
    protected $rules = [
        'name' => 'required',
        'slug' => 'required|alpha_dash|unique:countries',
    ];
}