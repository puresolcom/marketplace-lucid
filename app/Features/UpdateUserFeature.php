<?php

namespace App\Features;

use App\Data\Models\User;
use App\Domains\User\Events\UserUpdatedEvent;
use App\Domains\User\Jobs\CryptUserPasswordJob;
use App\Domains\User\Jobs\UpdateUserInputFilterJob;
use App\Domains\User\Jobs\UpdateUserInputValidateJob;
use App\Domains\User\Jobs\UpdateUserJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
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
        //$this->run(new CapabilityCheckJob(function ($auth) {
        //
        //    if ($auth->hasRole('seller')) {
        //        return $auth->getUser()->id == $this->userID;
        //    }
        //
        //    return true;
        //}));

        // Find user
        $user = $this->run(FindObjectByIDJob::class, ['model' => User::class, 'objectID' => $this->userID]);
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