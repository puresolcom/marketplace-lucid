<?php

namespace App\Features;

use App\Data\Models\Role;
use App\Domains\Role\Jobs\DeleteRoleJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;

class DeleteRoleFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle()
    {
        $model   = $this->run(FindObjectByIDJob::class, ['model' => Role::class, 'objectID' => $this->objectID]);
        $deleted = $this->run(DeleteRoleJob::class, ['model' => $model]);

        if (! $deleted) {
            return $this->run(new JsonErrorResponseJob('Unable to delete Role'));
        }

        return $this->run(new JsonResponseJob('Role Deleted Successfully'));
    }
}