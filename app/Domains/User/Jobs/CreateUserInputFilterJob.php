<?php

namespace App\Domains\User\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateUserInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'name',
        'email',
        'phone_primary',
        'phone_secondary',
        'password',
        'active',
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