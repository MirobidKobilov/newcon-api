<?php

namespace App\Http\Controllers;

use App\Domain\Roles\Actions\CreateRoleAction;
use App\Domain\Roles\Actions\DeleteRoleAction;
use App\Domain\Roles\Actions\GetRolesListAction;
use App\Domain\Roles\Actions\UpdateRoleAction;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RolesController extends Controller
{
    
    protected $list_roles;
    protected $create_role;
    protected $update_role;
    protected $delete_role;

    public function __construct(GetRolesListAction $list_roles , CreateRoleAction $create_role ,UpdateRoleAction $update_role , DeleteRoleAction $delete_role)
    {
        $this->list_roles = $list_roles;
        $this->create_role = $create_role;
        $this->update_role = $update_role;
        $this->delete_role = $delete_role;
    }

    public function index()
    {
        return ($this->list_roles)();
    }

    public function create(CreateRoleRequest $request)
    {
        return ($this->create_role)($request);
    }

    public function update(UpdateRoleRequest $request , $id)
    {
        return ($this->update_role)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_role)($id);
    }
}
