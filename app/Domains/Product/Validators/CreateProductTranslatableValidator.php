<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class CreateProductTranslatableValidator extends Validator
{
    protected $rules = [
        'title'       => 'required|validate_base_locale',
        'description' => 'required|validate_base_locale',
    ];
}