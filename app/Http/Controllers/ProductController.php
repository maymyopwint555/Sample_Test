<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class ProductController extends Controller
{
    use MediaUploadingTrait;
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $data = Product::with('category','brand');

        if ($request->category_id) {
            $data->where('category_id', $request->category_id);
        }

        if ($request->brand_id) {
            $data->where('brand_id', $request->brand_id);
        }

        if (!empty($request->search)) {
            $search = $request->search;
            $data = $data->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('qty', 'LIKE', '%' . $search . '%')
                    ->orWhere('price', 'LIKE', '%' . $search . '%');
            });
        }
        $products = $data->orderBy('id','desc')->paginate(10);
        $firstItem = $products->firstItem();
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.index',compact('products','firstItem','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $products = $this->productService->updateProduct($request,$product);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->code = $product->code . '_deleted_' . now()->timestamp;
        $product->save();

        $product->delete();
        return redirect()->route('products.index');
    }
}
