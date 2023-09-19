<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryStoreRequest;

use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $validated_data = $request->validated();
        $category = new Category;

        $category->name = $validated_data['name'];
        $category->slug = Str::slug($validated_data['slug']);
        $category->description = $validated_data['description'];

        // Saving Image
        if ($request->hasFile('image')) {
            // Getting Image
            $file = $request->file('image');

            // Getting Image Extension
            $extension = $file->getClientOriginalExtension();

            // Giving unique name to Image for Storing
            $filename = time().'.'.$extension;

            // Saving Image in Storage
            $file->move('uploads/category/', $filename);

            // Uploading Image path in Database
            $category->image = 'uploads/category/'.$filename;
        }

        $category->meta_title = $validated_data['meta_title'];
        $category->meta_keyword = $validated_data['meta_keyword'];
        $category->meta_description = $validated_data['meta_description'];

        // Checking Status
        $category->status = $request->status == true ? '1' : '0';

        if($category->save()){
            return redirect(route('category.index'))->with('message', 'Category Inserted Successfully');
        }
        return redirect(route('category.index'))->with('message', 'Something went wrong');
    }

    public function edit(Category $category)
    {
        // return $category;
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryStoreRequest $request, $category)
    {
        // return $request->status;

        $validated_data = $request->validated();

        $category = Category::findorFail($category);

        // return $category;

        // $category = new Category;

        $category->name = $validated_data['name'];
        $category->slug = Str::slug($validated_data['slug']);
        $category->description = $validated_data['description'];

        // Getting the Image Path
        $image_path = 'uploads/category/'.$category->image;
        // return $image_path;

        // Saving Image
        if ($request->hasFile('image')) {

            if(File::exists($image_path)){
                File::delete($image_path);
            }

            // Getting Image
            $file = $request->file('image');

            // Getting Image Extension
            $extension = $file->getClientOriginalExtension();

            // Giving unique name to Image for Storing
            $filename = time().'.'.$extension;

            // Saving Image in Storage
            $file->move('uploads/category/', $filename);

            // Uploading Image path in Database
            $category->image = 'uploads/category/'.$filename;
        }

        $category->meta_title = $validated_data['meta_title'];
        $category->meta_keyword = $validated_data['meta_keyword'];
        $category->meta_description = $validated_data['meta_description'];

        // Checking Status
        $category->status = $request->status == true ? '1' : '0';

        if($category->save()){
            return redirect(route('category.index'))->with('message', 'Category Updated Successfully');
        }
        return redirect(route('category.index'))->with('message', 'Something went wrong');
    }

    public function show($category)
    {
        
    }

    public function destroy(Category $category)
    {
        dd($category);
    }

}
