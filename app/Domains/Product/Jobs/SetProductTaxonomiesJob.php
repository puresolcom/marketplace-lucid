<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Taxonomy;
use Awok\Foundation\Job;

class SetProductTaxonomiesJob extends Job
{
    protected $input = [];

    protected $taxonomyIDs = [];

    protected $model;

    protected $hasTaxonomies = false;

    public function __construct($input, $model)
    {
        $this->input = $input;
        $this->model = $model;
    }

    public function handle()
    {
        if (isset($this->input['category_ids']) && is_array($this->input['category_ids'])) {
            $this->taxonomyIDs   = array_merge($this->taxonomyIDs, array_values($this->input['category_ids']));
            $this->hasTaxonomies = true;
        }

        if (isset($this->input['tag_ids']) && is_array($this->input['tag_ids'])) {
            $this->taxonomyIDs   = array_merge($this->taxonomyIDs, array_values($this->input['tag_ids']));
            $this->hasTaxonomies = true;
        }

        if ($this->hasTaxonomies) {
            $validTaxonomiesCount = $this->validateTaxonomyIDs($this->taxonomyIDs, count($this->taxonomyIDs));
            if (! $validTaxonomiesCount) {
                throw new \InvalidArgumentException(trans('One or more invalid taxonomies ID(s) were provided'));
            }

            return $this->model->taxonomies()->sync($this->taxonomyIDs);
        }

        return true;
    }

    public function validateTaxonomyIDs($ids, $expectedCount)
    {
        $taxonomiesCount = Taxonomy::whereIn('id', $ids)->count();

        return $taxonomiesCount == $expectedCount;
    }
}