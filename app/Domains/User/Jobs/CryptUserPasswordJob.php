<?php

namespace App\Domains\User\Jobs;

use Awok\Foundation\Job;

class CryptUserPasswordJob extends Job
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function handle()
    {
        if (! is_string($this->password) || strlen($this->password) === 0) {
            throw new \InvalidArgumentException('Password cannot be empty');
        }

        return app('hash')->make($this->password);
    }
}