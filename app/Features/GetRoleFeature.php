<?php

namespace App\Features;

use App\Data\Models\Role;
use Awok\Domains\Data\Jobs\FindEloquentObjectFromRequestJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Jobs\JsonResponseJob;

class GetRoleFeature extends Feature
{
    protected $roleID;

    public function __construct($roleID)
    {
        $this->roleID = $roleID;
    }

    public function handle()
    {
        $role = $this->run(FindEloquentObjectFromRequestJob::class, ['model' => Role::class, 'objectID' => $this->roleID]);

        return $this->run(new JsonResponseJob($role));
    }
}