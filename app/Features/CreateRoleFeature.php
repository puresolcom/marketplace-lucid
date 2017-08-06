<?php

namespace App\Features;

use App\Domains\Role\Jobs\CreateRoleInputFilterJob;
use App\Domains\Role\Jobs\CreateRoleInputValidateJob;
use App\Domains\Role\Jobs\CreateRoleJob;
use Awok\Foundation\Feature;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Http\Request;

/**
 * This feature is responsible fo creating new role
 *
 * Class CreateRoleFeature
 *
 * @package App\Features
 */
class CreateRoleFeature extends Feature
{
    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(CreateRoleInputValidateJob::class, ['input' => $request->all()]);
        // Exclude unwanted Inputs
        $filteredInputs = $this->run(CreateRoleInputFilterJob::class);
        // Create Role
        $roleCreated = $this->run(CreateRoleJob::class, ['input' => $filteredInputs]);
        // Return Response
        if (! $roleCreated) {
            return $this->run(new JsonErrorResponseJob('Unable to create role'));
        }

        return $this->run(new JsonResponseJob($roleCreated));
    }
}