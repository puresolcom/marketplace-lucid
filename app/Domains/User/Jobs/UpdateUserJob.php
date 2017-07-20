<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class UpdateUserJob extends Job
{
    protected $user;

    protected $userData;

    public function __construct(User $user, array $input)
    {
        $this->user     = $user;
        $this->userData = $input;
    }

    public function handle()
    {
        return $this->user->update($this->userData) ? $this->user : false;
    }
}