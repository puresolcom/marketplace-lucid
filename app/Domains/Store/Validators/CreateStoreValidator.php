<?php

namespace App\Domains\Store\Validators;

use Awok\Validation\Validator;

class CreateStoreValidator extends Validator
{
    protected $rules = [
        'name'             => 'required|string',
        'slug'             => 'required|slug:stores',
        'street_address_1' => 'required|string',
        'street_address_2' => 'string',
        'city_id'          => 'required|exists:locations,id',
        'country_id'       => 'exists:countries,id',
        'user_id'          => 'required|exists:users,id',
        'postal_code'      => 'min:5|max:12',
    ];
}