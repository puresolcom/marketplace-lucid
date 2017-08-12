<?php

namespace App\Domains\Product\Validators;

use Awok\Foundation\Http\Request;
use Awok\Validation\Validation;
use Awok\Validation\Validator;

class UpdateProductValidator extends Validator
{
    protected $request;

    protected $currentObjectID;

    protected $rules = [
        'price'          => 'numeric',
        'discount_price' => 'numeric',
        'stock'          => 'numeric',
        'currency_id'    => 'exists:currencies,id',
        'store_id'       => 'exists:stores,id',
    ];

    public function __construct(Validation $validation, Request $request)
    {
        $this->request         = $request;
        $this->currentObjectID = $this->request->segment(2);

        // Dynamic validation rules;
        $this->rules['upc'] = 'max:12|unique:products,upc,'.$this->currentObjectID;
        $this->rules['sku'] = 'max:12|unique:products,sku,'.$this->currentObjectID;

        parent::__construct($validation);
    }
}