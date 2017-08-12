<?php

namespace App\Domains\Store\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateStoreInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'name',
        'slug',
        'street_address_1',
        'street_address_2',
        'country_id',
        'city_id',
        'postal_code',
        'user_id',
    ];

    public function __construct(array $expectedKeys = [])
    {
        parent::__construct($expectedKeys);
    }

    public function handle(Request $request)
    {
        return parent::handle($request);
    }
}