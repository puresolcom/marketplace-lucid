<?php

namespace App\Operations;

use App\Domains\Product\Jobs\CreateProductJob;
use App\Domains\Product\Jobs\ExtractCreateProductFieldsJob;
use App\Domains\Product\Jobs\SaveProductTranslationJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class CreateProductOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(Application $app)
    {
        // begin transaction
        $app->make('db')->beginTransaction();

        try {
            // extract create product fields
            $createProductFields = $this->run(ExtractCreateProductFieldsJob::class);

            // extract translatable fields
            $productTranslations = $this->run(ExtractTranslatableFieldsOperation::class, [
                'input' => $this->input,
                'keys'  => ['title', 'description'],
            ]);

            // create a product
            $product = $this->run(CreateProductJob::class, ['input' => $createProductFields]);

            // create translations
            $this->run(SaveProductTranslationJob::class, ['input' => $productTranslations, 'model' => $product]);
        } catch (\Exception $e) {
            // rollback if exceptions are caught
            $app->make('db')->rollback();
            throw $e;
        }

        $results = $product->where('id', $product->id)->with(['store', 'currency', 'approved_by'])->get();
        // commit
        $app->make('db')->commit();

        return $results;
    }
}