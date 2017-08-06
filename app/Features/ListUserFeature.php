<?php

namespace App\Features;

use App\Data\Models\User;
use Awok\Domains\Data\Jobs\BuildEloquentQueryFromRequestJob;
use Awok\Foundation\Feature;
use Awok\Domains\Http\Jobs\JsonResponseJob;

class ListUserFeature extends Feature
{
    public function handle()
    {
        $results = $this->run(BuildEloquentQueryFromRequestJob::class, ['model' => User::class]);

        return $this->run(new JsonResponseJob($results));
    }
}