<?php

namespace App\Operations;

use App\Data\Models\Product;
use App\Domains\Product\Jobs\ExtractProductCategoriesJob;
use App\Domains\Product\Jobs\ExtractProductTagsJob;
use App\Domains\Product\Jobs\SetProductTaxonomiesJob;
use Awok\Foundation\Operation;

class SetProductTaxonomiesOperation extends Operation
{
    protected $input;

    protected $model;

    public function __construct($input, Product $model)
    {
        $this->input = $input;
        $this->model = $model;
    }

    public function handle()
    {
        $categoriesIDs = $this->run(ExtractProductCategoriesJob::class);
        $tagsIDs       = $this->run(ExtractProductTagsJob::class);

        $input   = array_merge($categoriesIDs, $tagsIDs);

        $this->run(SetProductTaxonomiesJob::class, ['input' => $input, 'model' => $this->model]);
    }
}