<?php

namespace App\Domains\Store\Jobs;

use App\Data\Models\Store;
use Awok\Foundation\Job;

class CreateStoreJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Store $model )
    {
    	return $model->create($this->data);
    }
}