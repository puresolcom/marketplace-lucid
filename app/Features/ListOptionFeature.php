<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use Awok\Domains\Data\Jobs\BuildEloquentQueryFromRequestJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use App\Data\Models\Option;

class ListOptionFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        $results = $this->run(BuildEloquentQueryFromRequestJob::class, ['model' => Option::class]);

		return $this->run(new JsonResponseJob($results));
    }
}