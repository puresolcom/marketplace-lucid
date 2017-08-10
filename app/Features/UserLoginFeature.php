<?php

namespace App\Features;

use App\Domains\User\Exceptions\InvalidCredentialsException;
use App\Domains\User\Jobs\FindUserByEmailJob;
use App\Domains\User\Jobs\KongAuthenticateJob;
use App\Domains\User\Jobs\UserLoginCredentialsCheckJob;
use App\Domains\User\Jobs\UserLoginInputValidateJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class UserLoginFeature extends Feature
{
    public function handle(Request $request)
    {
        $this->run(UserLoginInputValidateJob::class, ['input' => $request->all()]);
        $user = $this->run(FindUserByEmailJob::class, ['email' => $request->get('username')]);

        if (! $user) {
            throw new InvalidCredentialsException();
        }

        $this->run(UserLoginCredentialsCheckJob::class, [
            'credentials' => $request->only(['username', 'password']),
            'password'    => $user->password,
        ]);

        $result = $this->run(KongAuthenticateJob::class, ['user' => $user]);

        return $this->run(new JsonResponseJob($result));
    }
}