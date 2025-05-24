<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandService
{
    public function createBrand(Request $request)
    {
        $brand = Brand::create([
            'name' => $request->name
        ]);
        return $brand;
    }

    public function updateBrand(Request $request, Brand $brand)
    {
        $brand->update([
            'name' => $request->name
        ]);
        return $brand;
    }
}