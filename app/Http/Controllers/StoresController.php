<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListStoreFeature;
use App\Features\GetStoreFeature;
use App\Features\CreateStoreFeature;
use App\Features\UpdateStoreFeature;
use App\Features\DeleteStoreFeature;


class StoresController extends Controller
{
    public function index()
    {
        return $this->serve(ListStoreFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetStoreFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateStoreFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateStoreFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteStoreFeature::class, ['objectID' => $id]);
    }
}