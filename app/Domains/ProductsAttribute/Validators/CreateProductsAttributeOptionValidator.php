<?php

namespace App\Domains\ProductsAttribute\Validators;

use Awok\Validation\Validator;

class CreateProductsAttributeOptionValidator extends Validator
{
    protected $rules = [
        'options' => 'required_if:multiple,true|required_if:multiple,1',
    ];
}