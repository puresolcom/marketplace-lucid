<?php

namespace App\Domains\ProductsAttribute\Validators;

use Awok\Validation\Validation;
use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class CreateProductsAttributeValidator extends Validator
{
    public function __construct(Validation $validation)
    {
        $this->rules = [
            'type'          => ['required', Rule::in(['string', 'text', 'select', 'checkbox'])],
            'slug'          => 'required|slug:products_attributes',
            'multiple'      => 'boolean|required_if:type,select|required_if:type,checkbox',
            'configuration' => 'json',
            'required'      => 'boolean',
            'position'      => 'integer',
        ];
        parent::__construct($validation);
    }
}