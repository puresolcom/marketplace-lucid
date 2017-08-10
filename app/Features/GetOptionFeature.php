<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use Awok\Domains\Data\Jobs\FindEloquentObjectFromRequestJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use App\Data\Models\Option;

class GetOptionFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        $model = $this->run(FindEloquentObjectFromRequestJob::class, ['model' => Option::class, 'objectID' => $this->objectID]);

		return $this->run(new JsonResponseJob($model));
    }
}