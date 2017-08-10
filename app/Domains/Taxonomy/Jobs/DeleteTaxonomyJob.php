<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Data\Models\Taxonomy;
use Awok\Foundation\Job;

class DeleteTaxonomyJob extends Job
{

	protected $model;

    public function __construct( Taxonomy $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}