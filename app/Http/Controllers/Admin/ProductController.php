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

        // dd($request->all());
        $validatedData = $request->validated();
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

        // if ($request->color) {
        //     foreach ($request->color as $key => $color) {
        //         $product->colors()->create([
        //             'product_id'        => $product->id,
        //             'color_id'          => $color->id,
        //             'color_quantity'    => $request->color_quantity[$key],
        //         ]);
        //     }
        // }
        // if (is_array($request->color)) {
        //     foreach ($request->color as $key => $colorId) {
        //         // dd($request->color_quantity[$key]);
        //         $qty = intval($colorId - 1);
        //         $color_id = intval($colorId);
        //         // dd($color_id);
        //         // dd($qty);
        //         $product->colors()->attach([
        //             'product_id' => $product->id,
        //             'color_id' => $color_id,
        //             'color_quantity' => $request->color_quantity[$qty],
        //         ]);
        if (is_array($request->color)) {
            foreach ($request->color as $key => $colorId) {
                $qty = intval($colorId - 1);
                $color_id = intval($colorId);

                $product->colors()->attach($color_id, [
                    'product_id' => $product->id,
                    'color_quantity' => $request->color_quantity[$qty],
                ]);
            }
        }
        // }
        // }
        return redirect()->route('products.index')->with('success', 'Product with Images created successfully');
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

        // Fetch colors associated with the product
        $productColors = $product->colors;
        // return $productColors;
        // Fetch colors not associated with the product
        $colors = Color::whereNotIn('id', $productColors->pluck('id'))->get();

        // return $colors;

        return view('admin.products.edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
            'productColors' => $productColors,
            'colors' => $colors,
        ]);
    }

    public function update(ProductFormRequest $request, $id)
    {
        // dd($request->all());
        // Validate the request
        $validatedData = $request->validated();
        // Find the category
        $category = Category::findOrFail($validatedData['category_id']);
        // Find the product within the category
        $product = Product::find($id);
        if ($product) {
            // Update the product data
            $product->update([
                'category_id'       => $validatedData['category_id'],
                'name'              => $validatedData['name'],
                'slug'              => Str::slug($validatedData['slug']),
                'brand'             => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description'       => $validatedData['description'],
                'meta_title'        => $validatedData['meta_title'],
                'meta_keyword'      => $validatedData['meta_keyword'],
                'meta_description'  => $validatedData['meta_description'],
                'original_price'    => $validatedData['original_price'],
                'selling_price'     => $validatedData['selling_price'],
                'quantity'          => $validatedData['quantity'],
                'trending'          => $request->boolean('trending') ? 1 : 0,
                'status'            => $request->boolean('status') ? 1 : 0,
            ]);

            // Upload and attach product images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $image_name = time() . $key . '.' . $extension;
                    $image->move('uploads/products/', $image_name);
                    $final_image = 'uploads/products/' . $image_name;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image'      => $final_image,
                    ]);
                }
            }

            if ($request->color) {
                foreach ($request->color as $key => $colorId) {
                    $color_id = intval($colorId);
                    // Update the color_quantity for the specific color in the pivot table
                    $product->colors()->attach($color_id, [
                        'color_quantity' => $request->color_quantity[$key],
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Product with Images updated successfully');
        }

        return redirect()->back()->with('error', 'Product not found');
    }

    public function update_color_products_quantity(Request $request, $color_product_id)
    {
        $colorProduct = ColorProduct::findOrFail($color_product_id);
        if ($colorProduct) {
            // Update the color_quantity for the specific product and color in the pivot table
            $colorProduct->update([
                'color_quantity' => $request->quantity,
            ]);

            return response()->json(['message' => 'Quantity Updated successfully']);
        }

        return response()->json(['error' => 'Quantity did not Updated successfully']);
    }


    public function delete_color_products_quantity($color_product_id)
    {
        $color_product = ColorProduct::findOrFail($color_product_id);
        if ($color_product) {
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
