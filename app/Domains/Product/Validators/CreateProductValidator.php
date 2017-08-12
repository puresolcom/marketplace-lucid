<?php

namespace App\Domains\Product\Validators;

use Awok\Validation\Validator;

class CreateProductValidator extends Validator
{
    protected $rules = [
        'upc'            => 'required|max:12|unique:products',
        'sku'            => 'required|max:12',
        'stock'          => 'required|numeric',
        'price'          => 'required|numeric',
        'discount_price' => 'numeric',
        'currency_id'    => 'required|exists:currencies,id',
        'store_id'       => 'required|exists:stores,id',
        'active'         => 'numeric',
        'approved'       => 'numeric',
        'approved_by'    => 'numeric',
    ];
}