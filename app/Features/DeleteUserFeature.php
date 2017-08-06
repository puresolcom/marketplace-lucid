<?php

namespace App\Features;

use App\Domains\User\Jobs\DeleteUserJob;
use App\Domains\User\Jobs\FindUserByIDJob;
use Awok\Foundation\Feature;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;

class DeleteUserFeature extends Feature
{
    protected $userID;

    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function handle()
    {
        $user        = $this->run(FindUserByIDJob::class, ['userID' => $this->userID]);
        $userDeleted = $this->run(DeleteUserJob::class, ['user' => $user]);

        if (! $userDeleted) {
            return $this->run(new JsonErrorResponseJob('Unable to delete user'));
        }

        return $this->run(new JsonResponseJob('User Deleted Successfully'));
    }
}