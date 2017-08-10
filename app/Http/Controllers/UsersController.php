<?php

namespace App\Http\Controllers;

use App\Features\CreateUserFeature;
use App\Features\DeleteUserFeature;
use App\Features\GetUserFeature;
use App\Features\GetUserRolesFeature;
use App\Features\ListUserFeature;
use App\Features\UpdateUserFeature;
use App\Features\UserLoginFeature;
use Awok\Foundation\Controller;

class UsersController extends Controller
{
    public function login()
    {
        return $this->serve(UserLoginFeature::class);
    }

    public function index()
    {
        return $this->serve(ListUserFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetUserFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateUserFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateUserFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteUserFeature::class, ['objectID' => $id]);
    }

    public function getRoles($id)
    {
        return $this->serve(GetUserRolesFeature::class, ['objectID' => $id]);
    }
}