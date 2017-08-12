<?php

namespace App\Domains\Store\Validators;

use Awok\Validation\Validator;

class UpdateStoreValidator extends Validator
{
    protected $rules = [
        'name'             => 'string',
        'street_address_1' => 'string',
        'street_address_2' => 'string',
        'city_id'          => 'exists:locations,id',
        'country_id'       => 'exists:countries,id',
        'postal_code'      => 'min:5|max:12',
    ];
}