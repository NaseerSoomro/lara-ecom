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
        $trendingProducts = Product::where('trending', '1')->latest()->take(10)->get();
        return view('Frontend.index', compact('sliders', 'trendingProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status', '1')->get();
        return view('Frontend.category.index', compact('categories'));
    }

    public function new_arrivals()
    {
        $newArrivals = Product::where('status', '1')->latest()->take(5)->get();
        // dd($newArrivals);
        return view('frontend.pages.new_arrivals', compact('newArrivals'));
    }

    function featured_products() 
    {
        $featuredProducts = Product::where('featured', '1')->get();
        // $featuredProducts = Product::where('featured', '1')->latest()->take(5)->get();
        // dd($featuredProducts);
        return view('frontend.pages.featured_products', ['featuredProducts' => $featuredProducts]);
    }

    public function category_products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            // $products = $category->products()->get();
            return view('frontend.products.index', compact('category'));
        }
        return redirect()->back()->with('error', 'Category Does not Exists');
    }

    public function category_product_view($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        // dd($category);
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '1')->first();
            // dd($product);
            if ($product) {
                $product_images = $product->productImages()->get();
                // dd($product_images);
                return view('frontend.products.view', compact('category', 'product', 'product_images'));
            }
            return redirect()->back()->with('error', 'Products Does not Exists');
        }
        return redirect()->back()->with('error', 'Category Does not Exists');
    }

    public function thank_you()
    {
        return view('frontend.thank_you');
    }

}


