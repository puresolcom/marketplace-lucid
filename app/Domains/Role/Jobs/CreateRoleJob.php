<?php

namespace App\Domains\Role\Jobs;

use App\Data\Models\Role;
use Awok\Foundation\Job;

class CreateRoleJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Role $model )
    {
    	return $model->create($this->data);
    }
}