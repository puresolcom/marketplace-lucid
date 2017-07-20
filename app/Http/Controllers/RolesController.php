<?php

namespace App\Http\Controllers;

use App\Features\CreateRoleFeature;
use App\Features\DeleteRoleFeature;
use App\Features\GetRoleFeature;
use App\Features\ListRoleFeature;
use App\Features\UpdateRoleFeature;
use Awok\Foundation\Controller;

class RolesController extends Controller
{
    public function index()
    {
        return $this->serve(ListRoleFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetRoleFeature::class, ['roleID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateRoleFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateRoleFeature::class, ['roleID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteRoleFeature::class, ['roleID' => $id]);
    }
}