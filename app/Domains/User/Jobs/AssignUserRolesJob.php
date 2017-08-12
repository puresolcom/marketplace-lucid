<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class AssignUserRolesJob extends Job
{
    protected $model;

    protected $roleIds;

    public function __construct(User $model, $roleIds = [])
    {
        $this->model   = $model;
        $this->roleIds = $roleIds;
    }

    public function handle()
    {
        return $this->model->roles()->sync($this->roleIds);
    }
}