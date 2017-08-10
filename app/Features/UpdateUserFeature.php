<?php

namespace App\Features;

use App\Data\Models\User;
use App\Domains\User\Jobs\CryptPasswordJob;
use App\Domains\User\Jobs\UpdateUserInputFilterJob;
use App\Domains\User\Jobs\UpdateUserInputValidateJob;
use App\Domains\User\Jobs\UpdateUserJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class UpdateUserFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(UpdateUserInputValidateJob::class, ['input' => $request->all()]);
        // Finding model
        $model = $this->run(FindObjectByIDJob::class, ['model' => User::class, 'objectID' => $this->objectID]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(UpdateUserInputFilterJob::class);

        // Crypt user password
        $filteredInputs['password'] = $this->run(CryptPasswordJob::class, ['password' => $filteredInputs['password']]);

        // Update model
        $updated = $this->run(UpdateUserJob::class, ['model' => $model, 'input' => $filteredInputs]);

        // Response
        if (! $updated) {
            return $this->run(new JsonErrorResponseJob('Unable to update User'));
        }

        return $this->run(new JsonResponseJob($updated));
    }
}