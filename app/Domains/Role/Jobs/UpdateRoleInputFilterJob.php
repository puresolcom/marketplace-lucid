<?php

namespace App\Domains\Role\Jobs;

use Awok\Foundation\InputFilterJob;

class UpdateRoleInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'role',
        'name',
    ];
}
