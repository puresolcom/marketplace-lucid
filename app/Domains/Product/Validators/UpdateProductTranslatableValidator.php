<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class UpdateProductTranslatableValidator extends Validator
{
    protected $rules = [
        'title'       => 'translatable_object:2,255',
        'description' => 'min:5|max:255',
    ];
}