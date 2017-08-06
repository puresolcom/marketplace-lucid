<?php

namespace App\Features;

use App\Domains\User\Events\UserCreatedEvent;
use App\Domains\User\Jobs\CreateUserInputFilterJob;
use App\Domains\User\Jobs\CreateUserInputValidateJob;
use App\Domains\User\Jobs\CreateUserJob;
use App\Domains\User\Jobs\CryptUserPasswordJob;
use Awok\Foundation\Feature;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Http\Request;

/**
 * This feature is responsible of creating A new user
 *
 * Class CreateUserFeature
 *
 * @package App\Features
 */
class CreateUserFeature extends Feature
{
    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(CreateUserInputValidateJob::class, ['input' => $request->all()]);
        // Exclude unwanted Inputs
        $filteredInputs = $this->run(CreateUserInputFilterJob::class);
        // Crypt Plain Password
        $filteredInputs['password'] = $this->run(CryptUserPasswordJob::class, ['password' => $filteredInputs['password']]);
        // Create User
        $userCreated = $this->run(CreateUserJob::class, ['input' => $filteredInputs]);
        // Return Response
        if (! $userCreated) {
            return $this->run(new JsonErrorResponseJob('Unable to create user'));
        }

        event(new UserCreatedEvent($userCreated));

        return $this->run(new JsonResponseJob($userCreated));
    }
}