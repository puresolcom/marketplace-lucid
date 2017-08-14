<?php

namespace App\Domains\Taxonomy\Validators;

use Awok\Foundation\Http\Request;
use Awok\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateTaxonomyValidator extends Validator
{
    public function __construct(\Awok\Validation\Validation $validation, Request $request)
    {
        $this->rules = [
            'type'      => [Rule::in(['category', 'tag'])],
            'parent_id' => 'numeric|exists:taxonomies,id',
            'name'      => 'translatable_object|validate_base_locale',
            'slug'      => "slug:taxonomies,{$request->segment(2)}",
        ];
        parent::__construct($validation);
    }
}