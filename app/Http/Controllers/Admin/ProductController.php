<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\ColorProduct;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.products.create', compact('brands', 'categories', 'colors'));
    }

    public function store(ProductFormRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        // dd($validatedData['category_id']);
        // Way 1
        // $product = new Product;
        // $product->category_id       =   $validatedData['category_id'];
        // $product->name              =   $validatedData['name'];
        // $product->slug              =   Str::slug($validatedData['slug']);
        // $product->brand             =   $validatedData['brand'];
        // $product->small_description =   $validatedData['small_description'];
        // $product->description       =   $validatedData['description'];
        // $product->meta_title        =   $validatedData['meta_title'];
        // $product->meta_keyword      =   $validatedData['meta_keyword'];
        // $product->meta_description  =   $validatedData['meta_description'];
        // $product->original_price    =   $validatedData['original_price'];
        // $product->selling_price     =   $validatedData['selling_price'];
        // $product->quantity          =   $validatedData['quantity'];
        // $product->trending          =   $request->trending == true ? '1' : '0';
        // $product->status            =   $request->status == true ? '1' : '0';


        // if ($product->save()) {
        //     if ($request->hasFile('image')) {
        //         $i = 1;
        //         foreach ($request->file('image') as $image) {
        //             $extension = $image->getClientOriginalExtension();
        //             $image_name = time() . $i++ . '.' . $extension;
        //             $image->move('uploads/products/', $image_name);
        //             $final_image = 'uploads/products/' . $image_name;

        //             $product_images = new ProductImage();
        //             $product_images->product_id = $product->id;
        //             $product_images->image = $final_image;
        //             $product_images->save();
        //         }
        //         if ($product_images->save()) {
        //             return redirect()->back()->with('success', 'Product with Images created successfully');
        //         }
        //     }
        //     return redirect()->back()->with('error', 'Product did not created');
        // }
        // return redirect()->back()->with('error', 'Product did not created');

        $category_id = Category::findOrFail($validatedData['category_id']);
        // dd($category_id);
        // Way 2
        $product = $category_id->products()->create([
            'categroy_id'       =>   $validatedData['category_id'],
            'name'              =>   $validatedData['name'],
            'slug'              =>   Str::slug($validatedData['slug']),
            'brand'             =>   $validatedData['brand'],
            'small_description' =>   $validatedData['small_description'],
            'description'       =>   $validatedData['description'],
            'meta_title'        =>   $validatedData['meta_title'],
            'meta_keyword'      =>   $validatedData['meta_keyword'],
            'meta_description'  =>   $validatedData['meta_description'],
            'original_price'    =>   $validatedData['original_price'],
            'selling_price'     =>   $validatedData['selling_price'],
            'quantity'          =>   $validatedData['quantity'],
            'trending'          =>   $request->trending == true ? '1' : '0',
            'status'            =>   $request->status == true ? '1' : '0',
        ]);

        if ($request->hasFile('image')) {
            $i = 1;
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $image_name = time() . $i++ . '.' . $extension;
                $image->move('uploads/products/', $image_name);
                $final_image = 'uploads/products/' . $image_name;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image'      => $final_image,
                ]);
            }
        }

        if ($request->color) {
            foreach ($request->color as $key => $color) {
                $product->colorProducts()->create([
                    'product_id'    => $product->id,
                    'color_id'    => $color->id,
                    'color_quantity'    => $request->color_quantity[$key],
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product with Images created successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        $colorProduct = $product->colorProducts()->pluck('color_id')->toArray();
        // return $colorProduct;
        $colors = Color::whereNotIn('id', $colorProduct)->get();
        // return $colors;
        return view('admin.products.edit', ['product' => $product, 'brands' => $brands, 'categories' => $categories, 'colors' => $colors]);
    }
    public function update(ProductFormRequest $request, $id)
    {
        // dd($request->all()); 

        //     dd($id);
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        // dd($category);

        $product = $category->products()->where('id', $id)->first();
        // dd($product?);
        if ($product) {
            $product->update([
                'category_id'       =>   $validatedData['category_id'], // Fixed typo: 'categroy_id' to 'category_id'
                'name'              =>   $validatedData['name'],
                'slug'              =>   Str::slug($validatedData['slug']),
                'brand'             =>   $validatedData['brand'],
                'small_description' =>   $validatedData['small_description'],
                'description'       =>   $validatedData['description'],
                'meta_title'        =>   $validatedData['meta_title'],
                'meta_keyword'      =>   $validatedData['meta_keyword'],
                'meta_description'  =>   $validatedData['meta_description'],
                'original_price'    =>   $validatedData['original_price'],
                'selling_price'     =>   $validatedData['selling_price'],
                'quantity'          =>   $validatedData['quantity'],
                'trending'          =>   $request->trending == true ? '1' : '0',
                'status'            =>   $request->status == true ? '1' : '0',
            ]);

            // dd($product); // This will show the updated product
        }
        if ($request->hasFile('image')) {
            $i = 1;
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $image_name = time() . $i++ . '.' . $extension;
                $image->move('uploads/products/', $image_name);
                $final_image = 'uploads/products/' . $image_name;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image'      => $final_image,
                ]);
            }
        }

        if ($request->color) {
            foreach ($request->color as $key => $color) {
                // dd($color);
                $product->colorProducts()->create([
                    'product_id'    => $product->id,
                    'color_id'      => $color,
                    'color_quantity'    => $request->color_quantity[$key],
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product with Images updated successfully');
    }

    public function update_color_products_quantity(Request $request, $color_product_id)
    {
        // dd($request->all());
        $color_product = ColorProduct::findOrFail($color_product_id);
        if ($color_product) {
            $color_product->update([
                'color_quantity' => $request->quantity,
            ]);
            return response()->json(['message' => 'Quantity Updated successfully']);
        }
        return response()->json(['error' => 'Quantity did not Updated successfully']);
    }

    public function delete_color_products_quantity($color_product_id)
    {
        $color_product = ColorProduct::findOrFail($color_product_id);
        if($color_product){
            $color_product->delete();
            return response()->json(['message' => 'Quantity Deleted successfully']);
        }
        return response()->json(['message' => 'Quantity did not Deleted successfully']);
    }

    public function destroy_image($id)
    {
        $image = ProductImage::findOrFail($id);
        // dd($image->image);
        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        }
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        // Loop through product images and delete them from filesystem
        foreach ($product->productImages as $image) {
            if (File::exists(public_path($image->image))) {
                File::delete(public_path($image->image));
            }
        }

        // Delete associated product images from database
        $product->productImages()->delete();

        // Delete the product itself
        if ($product->delete()) {
            return redirect()->back()->with('success', 'Product with Images deleted successfully');
        }

        return redirect()->back()->with('error', 'Product with Images could not be deleted');
    }
}
