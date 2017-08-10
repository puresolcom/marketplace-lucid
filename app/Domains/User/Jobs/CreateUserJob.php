<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Awok\Foundation\Job;

class CreateUserJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( User $model )
    {
    	return $model->create($this->data);
    }
}