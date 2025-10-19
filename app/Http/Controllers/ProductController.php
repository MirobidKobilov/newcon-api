<?php

namespace App\Http\Controllers;

use App\Domain\Product\Actions\CreateProductAction;
use App\Domain\Product\Actions\DeleteProductAction;
use App\Domain\Product\Actions\GetProductListAction;
use App\Domain\Product\Actions\SearchProductAction;
use App\Domain\Product\Actions\UpdateProductAction;
use App\Exports\ProductExport;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    protected $product_list;
    protected $create_product;
    protected $update_product;
    protected $delete_product;
    protected $search_product;

    public function __construct(GetProductListAction $product_list , CreateProductAction $create_product , UpdateProductAction $update_product , DeleteProductAction $delete_product , SearchProductAction $search_product)
    {
        $this->product_list = $product_list;
        $this->create_product = $create_product;
        $this->update_product = $update_product;
        $this->delete_product  = $delete_product;
        $this->search_product = $search_product;
    }

    public function index(Request $request)
    {
        return ($this->product_list)($request);
    }

    public function create(CreateProductRequest $request)
    {
        return ($this->create_product)($request);
    }

    public function update(UpdateProductRequest $request , $id)
    {
        return ($this->update_product)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_product)($id);
    }

    public function search(Request $request)
    {
        return ($this->search_product)($request);
    }

    public function export()
    {
        return Excel::download(new ProductExport , 'products.xlsx');
    }

}
