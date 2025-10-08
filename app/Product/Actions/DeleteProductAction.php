<?php


namespace App\Product\Actions;

use App\Product\Models\Product;

class DeleteProductAction{

    public function __invoke($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted succesfully',
        ]);
    }
}