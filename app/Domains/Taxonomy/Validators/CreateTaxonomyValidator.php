<?php

namespace App\Domains\Taxonomy\Validators;

use Awok\Validation\Validation;
use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class CreateTaxonomyValidator extends Validator
{
    public function __construct(Validation $validation)
    {
        $this->rules = [
            'type'      => ['required', Rule::in(['category', 'tag'])],
            'parent_id' => 'numeric',
            'name'      => 'required',
            'slug'      => 'min:1',
        ];
        parent::__construct($validation);
    }
}