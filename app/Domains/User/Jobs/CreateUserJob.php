<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class CreateUserJob extends Job
{
    protected $userData;

    public function __construct(array $input)
    {
        $this->userData = $input;
    }

    public function handle(User $user)
    {
        return $user->create($this->userData);
    }
}