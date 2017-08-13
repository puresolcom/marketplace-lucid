<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListProductsAttributeFeature;
use App\Features\GetProductsAttributeFeature;
use App\Features\CreateProductsAttributeFeature;
use App\Features\UpdateProductsAttributeFeature;
use App\Features\DeleteProductsAttributeFeature;


class ProductsAttributesController extends Controller
{
    public function index()
    {
        return $this->serve(ListProductsAttributeFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetProductsAttributeFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateProductsAttributeFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateProductsAttributeFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteProductsAttributeFeature::class, ['objectID' => $id]);
    }
}