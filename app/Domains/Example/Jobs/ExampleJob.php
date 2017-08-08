<?php

namespace App\Domains\Example\Jobs;

use Awok\Foundation\Job;

class ExampleJob extends Job
{
    protected $data;

    /**
     * ExampleJob constructor.
     *
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->data.' Exemplified';
    }
}