<?php

namespace App\Domains\User\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class AssignRoleInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'role_ids',

    ];
}