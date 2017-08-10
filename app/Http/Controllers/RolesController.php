<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListRoleFeature;
use App\Features\GetRoleFeature;
use App\Features\CreateRoleFeature;
use App\Features\UpdateRoleFeature;
use App\Features\DeleteRoleFeature;


class RolesController extends Controller
{
    public function index()
    {
        return $this->serve(ListRoleFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetRoleFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateRoleFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateRoleFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteRoleFeature::class, ['objectID' => $id]);
    }
}