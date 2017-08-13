<?php

namespace App\Domains\ProductsAttribute\Validators;

use Awok\Validation\Validator;

class CreateProductsAttributeTranslatableValidator extends Validator
{
    protected $rules = [
        'name' => 'required',
    ];
}