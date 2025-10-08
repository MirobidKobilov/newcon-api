<?php

namespace App\Http\Controllers;

use App\MaterialType\Actions\CreateMaterialTypeAction;
use App\MaterialType\Actions\DeleteMaterialTypeAction;
use App\MaterialType\Actions\GetMaterialTypeListAction;
use App\MaterialType\Actions\UpdateMaterialTypeAction;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    
    protected $material_type_list;
    protected $create_material_type;
    protected $update_material_type;
    protected $delete_material_type;

    public function __construct(GetMaterialTypeListAction $material_type_list , CreateMaterialTypeAction $create_material_type , UpdateMaterialTypeAction $update_material_type , DeleteMaterialTypeAction $delete_material_type)
    {
        $this->material_type_list = $material_type_list;
        $this->create_material_type = $create_material_type;
        $this->update_material_type = $update_material_type;
        $this->delete_material_type = $delete_material_type;
        
    }

    public function index()
    {
        return ($this->material_type_list)();
    }

    public function create(Request $request)
    {
        return ($this->create_material_type)($request);
    }

    public function update(Request $request , $id)
    {
        return ($this->update_material_type)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_material_type)($id);
    }
}
