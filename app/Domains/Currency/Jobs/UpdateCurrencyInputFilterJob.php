<?php

namespace App\Domains\Currency\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class UpdateCurrencyInputFilterJob extends InputFilterJob
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