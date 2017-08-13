<?php

namespace App\Domains\ProductsAttribute\Validators;

use Awok\Foundation\Http\Request;
use Awok\Validation\Validation;
use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateProductsAttributeValidator extends Validator
{
    public function __construct(Validation $validation, Request $request)
    {
        $this->rules = [
            'type'          => [Rule::in(['string', 'text', 'select', 'checkbox'])],
            'slug'          => 'slug:products_attributes,'.$request->segment(2),
            'multiple'      => 'boolean|required_if:type,select|required_if:type,checkbox',
            'configuration' => 'json',
            'required'      => 'boolean',
            'position'      => 'integer',
        ];
        parent::__construct($validation);
    }
}