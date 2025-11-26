<?php

namespace App\Http\Controllers;

use App\Domain\Worker\Actions\CreateWorkerAction;
use App\Domain\Worker\Actions\DeleteWorkerAction;
use App\Domain\Worker\Actions\GetWorkerAction;
use App\Domain\Worker\Actions\GetWorkerListAction;
use App\Domain\Worker\Actions\UpdateWorkerAction;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    protected $create_worker;
    protected $workers_list;
    protected $update_worker;
    protected $delete_worker;
    protected $get_worker;

    public function __construct(CreateWorkerAction $create_worker , GetWorkerListAction $get_worker_list , UpdateWorkerAction $update_worker , DeleteWorkerAction $delete_worker , GetWorkerAction $get_worker)
    {
        $this->create_worker = $create_worker;
        $this->workers_list = $get_worker_list;
        $this->update_worker = $update_worker;
        $this->delete_worker = $delete_worker;
        $this->get_worker = $get_worker;
    }

    public function list(Request $request)
    {
        return $this->workers_list->execute($request);
    }

    public function create(CreateWorkerRequest $request)
    {
        return $this->create_worker->execute($request);
    }

    public function update(UpdateWorkerRequest $request , $id)
    {
        return $this->update_worker->execute($request , $id);
    }

    public function delete($id)
    {
        return $this->delete_worker->execute($id);
    }

    public function get($id)
    {
        return $this->get_worker->execute($id);
    }
}
