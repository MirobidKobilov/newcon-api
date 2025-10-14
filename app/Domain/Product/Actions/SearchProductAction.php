<?php
namespace App\Domain\Product\Actions;
use App\Domain\Product\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class SearchProductAction
{
    public function __invoke(Request $request)
    {
        $term = $request->term;
        
        if (empty($term)) {
            return ProductResource::collection(collect([]));
        }
        
        $term = trim($term);
        
        $products = Product::where('name', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%")
            ->orWhere('quantity' , "=" , $term)
            ->limit(50)
            ->get();
        
        return ProductResource::collection($products);
    }
}