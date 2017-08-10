<?php

namespace App\Domains\User\Jobs;

use Awok\Foundation\Job;

class CryptPasswordJob extends Job
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function handle()
    {
        return app('hash')->make($this->password);
    }
}