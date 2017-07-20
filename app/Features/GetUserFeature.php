<?php

namespace App\Features;

use App\Data\Models\User;
use Awok\Domains\Data\Jobs\FindEloquentObjectFromRequestJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Jobs\JsonResponseJob;

class GetUserFeature extends Feature
{
    protected $userID;

    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function handle()
    {
        $user = $this->run(FindEloquentObjectFromRequestJob::class, ['model' => User::class, 'objectID' => $this->userID]);

        return $this->run(new JsonResponseJob($user));
    }
}