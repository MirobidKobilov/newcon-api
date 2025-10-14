<?php

namespace App\Http\Controllers;

use App\Domain\Material\Actions\CreateMaterialAction;
use App\Domain\Material\Actions\DeleteMaterialAction;
use App\Domain\Material\Actions\GetMaterialListAction;
use App\Domain\Material\Actions\SearchMaterialAction;
use App\Domain\Material\Actions\UpdateMaterialAction;
use App\Exports\MaterialExport;
use App\Http\Requests\CreateMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{
    protected $material_list;
    protected $create_material;
    protected $update_material;
    protected $delete_material;
    protected $search_material;

    public function __construct(GetMaterialListAction $material_list , CreateMaterialAction $create_material , UpdateMaterialAction $update_material ,DeleteMaterialAction $delete_material  , SearchMaterialAction $search_material)
    {
        $this->material_list = $material_list;
        $this->create_material = $create_material;
        $this->update_material = $update_material;
        $this->delete_material = $delete_material;
        $this->search_material = $search_material;
    }

    public function index()
    {
        return ($this->material_list)();
    }

    public function create(CreateMaterialRequest $request)
    {
        return ($this->create_material)($request);
    }

    public function update(UpdateMaterialRequest $request , $id)
    {
        return ($this->update_material)($request, $id);
    }

    public function delete($id)
    {
        return ($this->delete_material)($id);
    }

    public function search(Request $request)
    {
        return ($this->search_material)($request);
    }

    public function export()
    {
        return Excel::download( new MaterialExport , 'material.xlsx');
    }
}
