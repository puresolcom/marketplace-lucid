<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use Awok\Foundation\Job;

class CreateProductJob extends Job
{
    protected $data;

    public function __construct(array $input)
    {
        $this->data = $input;
    }

    public function handle(Product $model)
    {
        return $model->create($this->data);
    }
}