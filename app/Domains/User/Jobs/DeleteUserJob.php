<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class DeleteUserJob extends Job
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        return $this->model->delete();
    }
}