<?php

namespace App\Domains\Role\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class UpdateRoleInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'role',
        'name',
    ];
}
