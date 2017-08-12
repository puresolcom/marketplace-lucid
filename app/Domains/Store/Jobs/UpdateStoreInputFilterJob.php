<?php

namespace App\Domains\Store\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class UpdateStoreInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'name',
        'street_address_1',
        'street_address_2',
        'city_id',
        'country_id',
        'postal_code',
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