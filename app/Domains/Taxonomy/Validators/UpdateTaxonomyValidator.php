<?php

namespace App\Domains\Taxonomy\Validators;

use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateTaxonomyValidator extends Validator
{
    public function __construct(\Awok\Validation\Validation $validation)
    {
        $this->rules = [
            'type'      => [Rule::in(['category', 'tag'])],
            'parent_id' => 'numeric',
            'name'      => 'translatable_object:3,64',
            'slug'      => 'slug:taxonomies',
        ];
        parent::__construct($validation);
    }
}