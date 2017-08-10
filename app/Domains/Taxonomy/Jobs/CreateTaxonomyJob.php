<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Data\Models\Taxonomy;
use Awok\Foundation\Job;

class CreateTaxonomyJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Taxonomy $model )
    {
    	return $model->create($this->data);
    }
}