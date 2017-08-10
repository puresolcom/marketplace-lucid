<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Domains\Taxonomy\Validators\UpdateTaxonomyValidator;
use Awok\Foundation\Job;

class UpdateTaxonomyInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateTaxonomyValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}