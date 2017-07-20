<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class DeleteUserJob extends Job
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        return $this->user->delete();
    }
}