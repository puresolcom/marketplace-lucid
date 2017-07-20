<?php

namespace App\Features;

use App\Domains\User\Events\UserUpdatedEvent;
use App\Domains\User\Jobs\CryptUserPasswordJob;
use App\Domains\User\Jobs\FindUserByIDJob;
use App\Domains\User\Jobs\UpdateUserInputFilterJob;
use App\Domains\User\Jobs\UpdateUserInputValidateJob;
use App\Domains\User\Jobs\UpdateUserJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Jobs\JsonErrorResponseJob;
use Awok\Foundation\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Http\Request;

/**
 * This feature is responsible of updating current user
 *
 * Class CreateUserFeature
 *
 * @package App\Features
 */
class UpdateUserFeature extends Feature
{
    protected $userID;

    public function __construct(int $userID)
    {
        $this->userID = $userID;
    }

    public function handle(Request $request)
    {
        // Find user
        $user = $this->run(FindUserByIDJob::class, ['userID' => $this->userID]);
        // Validate request input
        $this->run(UpdateUserInputValidateJob::class, ['input' => $request->all()]);
        // Exclude unwanted Inputs
        $filteredInputs = $this->run(UpdateUserInputFilterJob::class);
        // Crypt Plain Password
        if (isset($filteredInputs['password'])) {
            $filteredInputs['password'] = $this->run(CryptUserPasswordJob::class, ['password' => $filteredInputs['password']]);
        }
        // Update User
        $userUpdated = $this->run(UpdateUserJob::class, ['user' => $user, 'input' => $filteredInputs]);
        // Return Response
        if (! $userUpdated) {
            return $this->run(new JsonErrorResponseJob('Unable to create user'));
        }

        event(new UserUpdatedEvent($userUpdated));

        return $this->run(new JsonResponseJob($userUpdated));
    }
}