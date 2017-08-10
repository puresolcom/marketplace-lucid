<?php

namespace App\Features;

use App\Domains\User\Jobs\CreateUserInputFilterJob;
use App\Domains\User\Jobs\CreateUserInputValidateJob;
use App\Domains\User\Jobs\CreateUserJob;
use App\Domains\User\Jobs\CryptPasswordJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class CreateUserFeature extends Feature
{
    public function __construct()
    {
    }

    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(CreateUserInputValidateJob::class, ['input' => $request->all()]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(CreateUserInputFilterJob::class);

        // Crypt user password
        $filteredInputs['password'] = $this->run(CryptPasswordJob::class, ['password' => $filteredInputs['password']]);

        // Create model
        $created = $this->run(CreateUserJob::class, ['input' => $filteredInputs]);

        // Response
        if (! $created) {
            return $this->run(new JsonErrorResponseJob('Unable to create User'));
        }

        return $this->run(new JsonResponseJob($created));
    }
}