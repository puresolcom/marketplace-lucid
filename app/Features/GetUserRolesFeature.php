<?php

namespace App\Features;

use App\Data\Models\User;
use Awok\Domains\Data\Jobs\BuildEloquentQueryFromRequestJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;

class GetUserRolesFeature extends Feature
{
    protected $objectID;

    public function __construct($objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle()
    {
        $user   = $this->run(FindObjectByIDJob::class, ['model' => User::class, 'objectID' => $this->objectID]);
        $result = $this->run(BuildEloquentQueryFromRequestJob::class, ['model' => $user->roles()]);

        return $this->run(new JsonResponseJob($result));
    }
}
