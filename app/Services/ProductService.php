<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(Request $request)
    {
        $product = Product::create($request->all());
        return $product;
    }

    public function updateProduct(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }
}