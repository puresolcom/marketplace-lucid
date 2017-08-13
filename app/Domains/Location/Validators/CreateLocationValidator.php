<?php

namespace App\Domains\Location\Validators;

use Awok\Validation\Validation;
use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class CreateLocationValidator extends Validator
{
    public function __construct(Validation $validation)
    {
        $this->rules = [
            'name'       => 'min:2|max:64|required',
            'slug'       => 'min:2|max:64|required|slug:locations',
            'type'       => ['required', Rule::in(['city', 'area'])],
            'parent_id'  => 'nullable|numeric|exists:locations,id',
            'country_id' => 'nullable|required_if:type,city|numeric|exists:countries,id',
        ];
        parent::__construct($validation);
    }
}