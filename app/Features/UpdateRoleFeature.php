<?php

namespace App\Features;

use App\Domains\Role\Jobs\FindRoleByIDJob;
use App\Domains\Role\Jobs\UpdateRoleInputFilterJob;
use App\Domains\Role\Jobs\UpdateRoleInputValidateJob;
use App\Domains\Role\Jobs\UpdateRoleJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Jobs\JsonErrorResponseJob;
use Awok\Foundation\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Http\Request;

/**
 * This feature is responsible of updating current role
 *
 * Class CreateRoleFeature
 *
 * @package App\Features
 */
class UpdateRoleFeature extends Feature
{
    protected $roleID;

    public function __construct(int $roleID)
    {
        $this->roleID = $roleID;
    }

    public function handle(Request $request)
    {
        // Find role
        $role = $this->run(FindRoleByIDJob::class, ['roleID' => $this->roleID]);
        // Validate request input
        $this->run(UpdateRoleInputValidateJob::class, ['input' => $request->all()]);
        // Exclude unwanted Inputs
        $filteredInputs = $this->run(UpdateRoleInputFilterJob::class);
        // Update Role
        $roleUpdated = $this->run(UpdateRoleJob::class, ['role' => $role, 'input' => $filteredInputs]);
        // Return Response
        if (! $roleUpdated) {
            return $this->run(new JsonErrorResponseJob('Unable to create role'));
        }

        return $this->run(new JsonResponseJob($roleUpdated));
    }
}