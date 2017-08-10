<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListProductFeature;
use App\Features\GetProductFeature;
use App\Features\CreateProductFeature;
use App\Features\UpdateProductFeature;
use App\Features\DeleteProductFeature;


class ProductsController extends Controller
{
    public function index()
    {
        return $this->serve(ListProductFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetProductFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateProductFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateProductFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteProductFeature::class, ['objectID' => $id]);
    }
}