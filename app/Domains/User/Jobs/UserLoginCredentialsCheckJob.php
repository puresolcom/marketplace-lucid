<?php

namespace App\Domains\User\Jobs;

use App\Domains\User\Exceptions\InvalidCredentialsException;
use Awok\Foundation\Job;
use Illuminate\Contracts\Hashing\Hasher;

class UserLoginCredentialsCheckJob extends Job
{
    protected $credentials;

    protected $password;

    public function __construct($credentials, $password)
    {
        $this->credentials = $credentials;
        $this->password    = $password;
    }

    public function handle(Hasher $hasher)
    {
        if (! $hasher->check($this->credentials['password'], $this->password)) {
            throw new InvalidCredentialsException();
        }

        return true;
    }
}