<?php

namespace App\Domains\Role\Jobs;

use App\Data\Models\Role;
use Awok\Foundation\Job;

class UpdateRoleJob extends Job
{
    protected $role;

    protected $roleData;

    public function __construct(Role $role, array $input)
    {
        $this->role     = $role;
        $this->roleData = $input;
    }

    public function handle()
    {
        return $this->role->update($this->roleData) ? $this->role : false;
    }
}