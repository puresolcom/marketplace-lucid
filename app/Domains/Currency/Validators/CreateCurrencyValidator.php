<?php

namespace App\Domains\Currency\Validators;

use Awok\Validation\Validator;

class CreateCurrencyValidator extends Validator
{
    protected $rules = [
        'name'              => 'required',
        'symbol'            => 'required',
        'conversion_factor' => 'required|numeric',
        'active'            => 'numeric',
    ];
}