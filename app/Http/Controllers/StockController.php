<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(10);
        $firstItem = $products->firstItem();
        return view('stocks.index',compact('products','firstItem'));
    }
}
