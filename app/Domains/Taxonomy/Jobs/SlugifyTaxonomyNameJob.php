<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Data\Models\Taxonomy;
use Awok\Foundation\Job;

class SlugifyTaxonomyNameJob extends Job
{
    protected $rawSlug;

    public function __construct($rawSlug)
    {
        $this->rawSlug = $rawSlug;
    }

    public function handle()
    {
        $slug            = str_slug($this->rawSlug);
        $slugExistsCount = $this->slugExists($slug);
        $slug            = $slugExistsCount ? $slug.'-'.$slugExistsCount : $slug;

        return $slug;
    }

    protected function slugExists($slug)
    {
        $count = Taxonomy::where('slug', 'regexp', "^{$slug}-?[0-9]*$")->count();

        return $count;
    }
}