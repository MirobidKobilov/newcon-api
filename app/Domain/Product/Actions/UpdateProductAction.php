<?php
namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class UpdateProductAction
{
    public function execute(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->image = $request->file('image')->store('products', 'public');
        }
        
        $product->name = $request->name ?? $product->name;
        $product->description = $request->description ?? $product->description;
        $product->price = $request->price ?? $product->price;
        $product->status = $request->status ?? $product->status;
        
        $product->save(); 
        
        return new ProductResource($product);
    }
}