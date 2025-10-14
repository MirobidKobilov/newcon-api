<?php

namespace App\Http\Controllers;

use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\Actions\DeleteUserAction;
use App\Domain\User\Actions\GetUsersListAction;
use App\Domain\User\Actions\SearchUserAction;
use App\Domain\User\Actions\UpdateUserAction;
use App\Exports\UserExport;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    
    protected $user_list;
    protected $create_user;
    protected $update_user;
    protected $delete_user;
    protected $search_user;

    public function __construct(GetUsersListAction $user_list ,CreateUserAction $create_user , UpdateUserAction $update_user , DeleteUserAction $delete_user , SearchUserAction $search_user)
    {
        $this->user_list = $user_list;
        $this->create_user = $create_user;
        $this->update_user = $update_user;
        $this->delete_user = $delete_user;
        $this->search_user = $search_user;
    }


    public function index()
    {
        return ($this->user_list)();
    }

    public function create(CreateUserRequest $request)
    {
        return ($this->create_user)($request);
    }

    public function update(UpdateUserRequest $request , $id)
    {
        return ($this->update_user)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_user)($id);
    }

    public function search(Request $request)
    {
        return ($this->search_user)($request);
    }

    public function export()
    {
        return Excel::download( new UserExport , 'users.xlsx');
    }
}
