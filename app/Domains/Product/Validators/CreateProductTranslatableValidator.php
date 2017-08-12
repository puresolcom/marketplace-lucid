<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class CreateProductTranslatableValidator extends Validator
{
    protected $rules = [
        'title'       => 'required',
        'description' => 'required',
    ];
}