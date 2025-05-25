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
        if (count($request->input('photo', [])) > 0) {
            foreach ($request->input('photo', []) as $file) {
                $product->addMedia(storage_path('app/public/img/' . basename($file)))->toMediaCollection('photo');
            }
        }
        return $product;
    }

    public function updateProduct(Request $request, Product $product)
    {
        $product->update($request->all());
        if (count($product->photo) > 0) {
            foreach ($product->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        } elseif ($product->photo) {
            if (count($product->photo) > 0) {
                $product->photo->delete();
            }
        }
        $media = $product->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('app/public/img/' . basename($file)))->toMediaCollection('photo');
            }
        }
        return $product;
    }
}