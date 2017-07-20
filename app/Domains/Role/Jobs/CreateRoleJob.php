<?php

namespace App\Domains\Role\Jobs;

use App\Data\Models\Role;
use Awok\Foundation\Job;

class CreateRoleJob extends Job
{
    protected $roleData;

    public function __construct(array $input)
    {
        $this->roleData = $input;
    }

    public function handle(Role $role)
    {
        return $role->create($this->roleData);
    }
}