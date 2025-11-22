<?php

namespace App\Http\Controllers;

use App\Domain\Roles\Actions\CreateRoleAction;
use App\Domain\Roles\Actions\DeleteRoleAction;
use App\Domain\Roles\Actions\GetRolesListAction;
use App\Domain\Roles\Actions\SearchRoleAction;
use App\Domain\Roles\Actions\UpdateRoleAction;
use App\Exports\RoleExport;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RolesController extends Controller
{
    
    protected $list_roles;
    protected $create_role;
    protected $update_role;
    protected $delete_role;
    protected $search_role;

    public function __construct(GetRolesListAction $list_roles , CreateRoleAction $create_role ,UpdateRoleAction $update_role , DeleteRoleAction $delete_role , SearchRoleAction $search_role )
    {
        $this->list_roles = $list_roles;
        $this->create_role = $create_role;
        $this->update_role = $update_role;
        $this->delete_role = $delete_role;
        $this->search_role = $search_role;
    }

    public function index(Request $request)
    {
        return $this->list_roles->execute($request);
    }

    public function create(CreateRoleRequest $request)
    {
        return $this->create_role->execute($request);
    }

    public function update(UpdateRoleRequest $request , $id)
    {
        return $this->update_role->execute($request , $id);
    }

    public function delete($id)
    {
        return $this->delete_role->execute($id);
    }


    public function export()
    {
        return Excel::download( new RoleExport , 'role.xlsx');
    }
}
