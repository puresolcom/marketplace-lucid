<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListTaxonomyFeature;
use App\Features\GetTaxonomyFeature;
use App\Features\CreateTaxonomyFeature;
use App\Features\UpdateTaxonomyFeature;
use App\Features\DeleteTaxonomyFeature;


class TaxonomiesController extends Controller
{
    public function index()
    {
        return $this->serve(ListTaxonomyFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetTaxonomyFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateTaxonomyFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateTaxonomyFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteTaxonomyFeature::class, ['objectID' => $id]);
    }
}