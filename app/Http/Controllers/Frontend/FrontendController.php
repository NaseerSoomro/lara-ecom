<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::where('status', '1')->get();
        // dd($sliders);
        return view('Frontend.index', compact('sliders'));
    }

    public function categories()
    {
        $categories = Category::where('status', '1')->get();
        // dd($sliders);
        return view('Frontend.category.index', compact('categories'));
    }

    public function category_products($slug)
    {
        $category_products = Category::where('slug', $slug)->first();
        // dd($category_products);
        if ($category_products){
            // foreach ($category_products as $key => $c_p) {
                # code...
                $products = $category_products->products()->get();
                // $products = Product::where('slug', $c_p->slug)->get();
                // dd($products);
                // foreach ($products as $key => $p) {
                //     // $productImages = ProductImage::where('product_id', $p->id)->get();
                //     $productImages = $p->productImages()->get();
                // }
                // dd($productImages);
            // }
            return view('frontend.products.index', compact('products', 'category_products'));
        }
        return redirect()->back()->with('error', 'Category Does not Exists');
    }
}
