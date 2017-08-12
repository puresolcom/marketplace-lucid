<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class CreateProductValidator extends Validator
{
    protected $rules = [
        'upc'            => 'required|max:12|unique:products',
        'sku'            => 'required|max:12',
        'price'          => 'required|numeric',
        'discount_price' => 'numeric',
        'stock'          => 'required|numeric',
        'currency_id'    => 'required|exists:currencies,id',
        'store_id'       => 'required|exists:stores,id'
    ];
}