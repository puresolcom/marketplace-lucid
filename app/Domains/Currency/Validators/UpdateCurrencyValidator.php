<?php

namespace App\Domains\Currency\Validators;

use Awok\Validation\Validator;

class UpdateCurrencyValidator extends Validator
{
    protected $rules = [
        'conversion_factor' => 'numeric',
        'active'            => 'numeric',
    ];
}