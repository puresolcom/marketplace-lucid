<?php

namespace App\Http\Controllers;

use App\Features\CreateUserFeature;
use App\Features\DeleteUserFeature;
use App\Features\GetUserFeature;
use App\Features\GetUserRolesFeature;
use App\Features\ListUserFeature;
use App\Features\UpdateUserFeature;
use Awok\Foundation\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return $this->serve(ListUserFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetUserFeature::class, ['userID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateUserFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateUserFeature::class, ['userID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteUserFeature::class, ['userID' => $id]);
    }

    public function getUserRoles($id)
    {
        return $this->serve(GetUserRolesFeature::class, ['userID' => $id]);
    }
}
