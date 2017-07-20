<?php

namespace App\Features;

use App\Data\Models\Role;
use Awok\Domains\Data\Jobs\BuildEloquentQueryFromRequestJob;
use Awok\Foundation\Feature;

class ListRoleFeature extends Feature
{
    public function handle()
    {
        return $this->run(BuildEloquentQueryFromRequestJob::class, ['model' => Role::class, 'paginate' => true]);
    }
}