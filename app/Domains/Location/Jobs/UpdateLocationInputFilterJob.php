<?php

namespace App\Domains\Location\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class UpdateLocationInputFilterJob extends InputFilterJob
{

	protected $expectedKeys = [/** @todo add array of expected input keys here */];

    public function __construct( array $expectedKeys = [] )
    {
    	parent::__construct($expectedKeys);
    }

    public function handle( Request $request )
    {
    	return parent::handle($request);
    }
}