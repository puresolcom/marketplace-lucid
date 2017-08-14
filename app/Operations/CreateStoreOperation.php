<?php

namespace App\Operations;

use App\Domains\Store\Jobs\CreateStoreInputFilterJob;
use App\Domains\Store\Jobs\CreateStoreInputValidateJob;
use App\Domains\Store\Jobs\CreateStoreJob;
use App\Domains\Store\Jobs\SlugifyStoreNameJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class CreateStoreOperation extends Operation
{
    protected $app;

    public function __construct() { }

    public function handle(Application $app)
    {
        $this->app = $app;

        // Validate Request Inputs
        $this->run(CreateStoreInputValidateJob::class, ['input' => $this->app->make('request')->all()]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(CreateStoreInputFilterJob::class);

        $filteredInputs['slug'] = $this->run(SlugifyStoreNameJob::class, ['rawSlug' => $filteredInputs['slug']]);

        // Create model
        return $this->run(CreateStoreJob::class, ['input' => $filteredInputs]);
    }
}