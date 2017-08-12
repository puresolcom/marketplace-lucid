<?php

namespace App\Domains\Store\Jobs;

use Awok\Foundation\Job;

class SlugifyStoreNameJob extends Job
{
    protected $rawSlug;

    public function __construct($rawSlug)
    {
        $this->rawSlug = $rawSlug;
    }

    public function handle()
    {
        return str_slug($this->rawSlug);
    }
}