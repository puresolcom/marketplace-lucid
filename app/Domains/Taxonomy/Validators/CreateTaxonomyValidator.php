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
            'name'      => 'required|translatable_object:3,64',
            'slug'      => 'slug:taxonomies',
        ];
        parent::__construct($validation);
    }
}