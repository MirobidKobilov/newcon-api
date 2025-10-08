<?php

namespace App\Http\Controllers;

use App\Domain\Product\Actions\CreateProductAction;
use App\Domain\Product\Actions\DeleteProductAction;
use App\Domain\Product\Actions\GetProductListAction;
use App\Domain\Product\Actions\UpdateProductAction;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    protected $product_list;
    protected $create_product;
    protected $update_product;
    protected $delete_product;

    public function __construct(GetProductListAction $product_list , CreateProductAction $create_product , UpdateProductAction $update_product , DeleteProductAction $delete_product)
    {
        $this->product_list = $product_list;
        $this->create_product = $create_product;
        $this->update_product = $update_product;
        $this->delete_product  = $delete_product;
    }

    public function index()
    {
        return ($this->product_list)();
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

}
