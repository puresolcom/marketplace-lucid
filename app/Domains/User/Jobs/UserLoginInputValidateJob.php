<?php

namespace App\Domains\User\Jobs;

use App\Domains\User\Validators\LoginInputValidator;
use Awok\Foundation\Job;

class UserLoginInputValidateJob extends Job
{
    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function handle(LoginInputValidator $validator)
    {
        return $validator->validate($this->input);
    }
}