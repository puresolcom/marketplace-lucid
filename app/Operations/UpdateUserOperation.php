<?php

namespace App\Operations;

use App\Data\Models\User;
use App\Domains\User\Jobs\AssignRoleInputFilterJob;
use App\Domains\User\Jobs\AssignUserRolesJob;
use App\Domains\User\Jobs\CryptPasswordJob;
use App\Domains\User\Jobs\UpdateUserInputFilterJob;
use App\Domains\User\Jobs\UpdateUserInputValidateJob;
use App\Domains\User\Jobs\UpdateUserJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class UpdateUserOperation extends Operation
{
    protected $model;

    protected $app;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function handle(Application $app)
    {
        $this->app = $app;

        $this->app->make('db')->beginTransaction();

        $userUpdated = $this->updateUser();

        if (! $userUpdated) {
            $this->app->make('db')->rollBack();

            return $this->run(new JsonErrorResponseJob(trans('Unable to update user model')));
        }

        $userRolesAssigned = $this->assignUserRoles($userUpdated);

        if (! $userRolesAssigned) {
            $this->app->make('db')->rollBack();

            return $this->run(new JsonErrorResponseJob(trans('Unable to assign user roles')));
        }

        $this->app->make('db')->commit();

        return $this->model->load(['roles']);
    }

    protected function updateUser()
    {
        // Validate User update Inputs
        $this->run(UpdateUserInputValidateJob::class, ['input' => $this->app->make('request')->all()]);
        $updateUserFilteredInputs = $this->run(UpdateUserInputFilterJob::class);

        // Crypt user password
        if (isset($updateUserFilteredInputs['password'])) {
            $updateUserFilteredInputs['password'] = $this->run(CryptPasswordJob::class, ['password' => $updateUserFilteredInputs['password']]);
        }

        $updateUser = $this->run(UpdateUserJob::class, ['model' => $this->model, 'input' => $updateUserFilteredInputs]);

        return $updateUser;
    }

    protected function assignUserRoles($userUpdated)
    {
        $assignRolesFilteredInputs = $this->run(AssignRoleInputFilterJob::class);

        if (! empty($assignRolesFilteredInputs)) {
            $assignUserRoles = $this->run(AssignUserRolesJob::class, [
                'model'   => $userUpdated,
                'roleIds' => $assignRolesFilteredInputs['role_ids'],
            ]);

            return $assignUserRoles;
        }

        return true;
    }
}