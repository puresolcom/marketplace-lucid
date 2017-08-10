<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class FindUserByEmailJob extends Job
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function handle(User $model)
    {
        return $model->where('email', '=', $this->email)->first();
    }
}