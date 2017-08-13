<?php

namespace App\Domains\ProductsAttribute\Validators;

use Awok\Validation\Validator;

class UpdateProductsAttributeTranslatableValidator extends Validator
{
    protected $rules = [
        'name' => 'translatable_object',
    ];
}