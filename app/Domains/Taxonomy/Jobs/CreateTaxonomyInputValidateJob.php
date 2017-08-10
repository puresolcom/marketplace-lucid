<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Domains\Taxonomy\Validators\CreateTaxonomyValidator;
use Awok\Foundation\Job;

class CreateTaxonomyInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateTaxonomyValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}