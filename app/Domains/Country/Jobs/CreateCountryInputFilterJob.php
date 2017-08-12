<?php

namespace App\Domains\Country\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateCountryInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'name',
        'slug',
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