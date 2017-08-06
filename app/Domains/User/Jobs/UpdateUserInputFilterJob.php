<?php

namespace App\Domains\User\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class UpdateUserInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'first_name',
        'last_name',
        'password',
    ];
}
