<?php

namespace App\Operations;

use App\Data\Models\Store;
use App\Domains\Store\Jobs\UpdateStoreInputFilterJob;
use App\Domains\Store\Jobs\UpdateStoreInputValidateJob;
use App\Domains\Store\Jobs\UpdateStoreJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class UpdateStoreOperation extends Operation
{
    protected $app;

    protected $model;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public function handle(Application $app)
    {
        $this->app = $app;

        // Validate Request Inputs
        $this->run(UpdateStoreInputValidateJob::class, ['input' => $this->app->make('request')->all()]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(UpdateStoreInputFilterJob::class);

        // Update model
        $updated = $this->run(UpdateStoreJob::class, ['model' => $this->model, 'input' => $filteredInputs]);

        return $updated;
    }
}