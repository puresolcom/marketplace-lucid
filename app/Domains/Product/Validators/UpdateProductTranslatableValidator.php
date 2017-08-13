<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class UpdateProductTranslatableValidator extends Validator
{
    protected $rules = [
        'title'       => 'translatable_object',
        'description' => 'translatable_object',
    ];
}