<?php

namespace App\Features;

use App\Data\Models\User;
use Awok\Domains\Data\Jobs\BuildEloquentQueryFromRequestJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Jobs\JsonResponseJob;

class GetUserRolesFeature extends Feature
{
    protected $userID;

    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function handle()
    {
        $user   = $this->run(FindObjectByIDJob::class, ['model' => User::class, 'objectID' => $this->userID]);
        $result = $this->run(BuildEloquentQueryFromRequestJob::class, ['model' => $user->roles()]);

        return $this->run(new JsonResponseJob($result));
    }
}