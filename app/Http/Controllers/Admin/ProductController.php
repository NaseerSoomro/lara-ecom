<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProductFormRequest;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',['products' => $products]);
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category_id = Category::findOrFail($validatedData['category_id']);
        return $category_id;

        
    }

    public function show($id)
    {

    }

    public function edit(Product $product)
    {

    }
    public function update()
    {

    }

    public function destroy(Product $product)
    {

    }
}
