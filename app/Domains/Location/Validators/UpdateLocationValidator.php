<?php

namespace App\Domains\Location\Validators;

use Awok\Foundation\Http\Request;
use Awok\Validation\Validation;
use Awok\Validation\Validator;

class UpdateLocationValidator extends Validator
{
    public function __construct(Validation $validation, Request $request)
    {
        $this->rules = [
            'name'       => 'min:2|max:64',
            'slug'       => "min:2|max:64|slug:locations,{$request->segment(2)}",
            'country_id' => 'nullable|numeric|exists:countries,id',
            'parent_id'  => 'nullable|numeric|exists:locations,id',
        ];
        parent::__construct($validation);
    }
}