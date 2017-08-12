<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use Awok\Foundation\Job;

class SaveProductTranslationJob extends Job
{
    protected $data;

    protected $product;

    public function __construct(array $input, Product $model)
    {
        $this->data    = $input;
        $this->product = $model;
    }

    public function handle()
    {
        foreach ($this->data as $key => $translations) {
            foreach ($translations as $data) {
                $this->product->translations()->updateOrCreate(['locale' => $data->getLocale()], [$key => $data->getValue()]);
            }
        }
    }
}