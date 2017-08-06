<?php

namespace App\Features;

use App\Domains\Role\Jobs\DeleteRoleJob;
use App\Domains\Role\Jobs\FindRoleByIDJob;
use Awok\Foundation\Feature;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;

class DeleteRoleFeature extends Feature
{
    protected $roleID;

    public function __construct($roleID)
    {
        $this->roleID = $roleID;
    }

    public function handle()
    {
        $role        = $this->run(FindRoleByIDJob::class, ['roleID' => $this->roleID]);
        $roleDeleted = $this->run(DeleteRoleJob::class, ['role' => $role]);

        if (! $roleDeleted) {
            return $this->run(new JsonErrorResponseJob('Unable to delete role'));
        }

        return $this->run(new JsonResponseJob('Role Deleted Successfully'));
    }
}