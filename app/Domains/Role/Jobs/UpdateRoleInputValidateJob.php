<?php

namespace App\Domains\Role\Jobs;

use App\Domains\Role\Validators\UpdateRoleValidator;
use Awok\Foundation\Job;

class UpdateRoleInputValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(UpdateRoleValidator $validator)
    {
        return $validator->validate($this->input);
    }
}