<?php

namespace App\Domains\Role\Jobs;

use Awok\Foundation\InputFilterJob;

class CreateRoleInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'role',
        'name',
    ];
}
