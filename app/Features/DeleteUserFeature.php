<?php

namespace App\Features;

use App\Data\Models\User;
use App\Domains\User\Jobs\DeleteUserJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;

class DeleteUserFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle()
    {
        $model   = $this->run(FindObjectByIDJob::class, ['model' => User::class, 'objectID' => $this->objectID]);
        $deleted = $this->run(DeleteUserJob::class, ['model' => $model]);

        if (! $deleted) {
            return $this->run(new JsonErrorResponseJob('Unable to delete user'));
        }

        return $this->run(new JsonResponseJob('User Deleted Successfully'));
    }
}