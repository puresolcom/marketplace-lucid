<?php

namespace App\Domains\Role\Jobs;

use App\Data\Models\Role;
use Awok\Foundation\Job;

class DeleteRoleJob extends Job
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function handle()
    {
        return $this->role->delete();
    }
}