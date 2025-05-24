<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function createCategory(Request $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);
        return $category;
    }

    public function updateCategory(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);
        return $category;
    }
}