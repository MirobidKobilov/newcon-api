<?php

namespace App\Http\Controllers;

use App\Domain\Permission\Actions\CreatePermissionAction;
use App\Domain\Permission\Actions\DeletePermissionAction;
use App\Domain\Permission\Actions\GetPermissionsListAction;
use App\Domain\Permission\Actions\UpdatePermissionAction;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissions_list;
    protected $create_permission;
    protected $update_permission;
    protected $delete_permission;

    public function __construct(GetPermissionsListAction $permissions_list , CreatePermissionAction $create_permission , UpdatePermissionAction $update_permission , DeletePermissionAction $delete_permission)
    {
        $this->permissions_list = $permissions_list;
        $this->create_permission = $create_permission;
        $this->update_permission = $update_permission;
        $this->delete_permission = $delete_permission;
    }

    public function index()
    {
        return ($this->permissions_list)();
    }

    public function create(Request $request)
    {
        return ($this->create_permission)($request);
    }

    public function update(Request $request , $id)
    {
        return ($this->update_permission)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_permission)($id);
    }
}
