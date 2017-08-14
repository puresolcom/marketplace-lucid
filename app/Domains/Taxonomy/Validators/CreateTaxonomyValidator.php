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
            'parent_id' => 'numeric|exists:taxonomies,id',
            'name'      => 'required|translatable_object|validate_base_locale',
            'slug'      => 'required|slug:taxonomies',
        ];
        parent::__construct($validation);
    }
}