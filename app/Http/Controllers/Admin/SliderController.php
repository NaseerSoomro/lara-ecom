<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderFormRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $slider = Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $request->status == true ? '1' : '0',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/sliders', $filename);
            $slider->image = 'uploads/sliders/' . $filename;
        }

        if ($slider->save()) {
            return redirect('admin/sliders')->with('success', 'Slider with Image Created Successfully');
        }
        return redirect('admin/sliders')->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::find($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderFormRequest $request, $id)
    {
        $slider = Slider::find($id);
        // dd($slider);
        $validatedData = $request->validated();

        // Update the slider attributes
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->status = $request->status == true ? '1' : '0';

        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if (File::exists($slider->image)) {
                File::delete($slider->image);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/sliders', $filename);

            // Update the image attribute
            $slider->image = 'uploads/sliders/' . $filename;
        }

        // Save the updated slider
        if ($slider->save()) {
            return redirect('admin/sliders')->with('success', 'Slider with Image Updated Successfully');
        }

        return redirect('admin/sliders')->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);

    if ($slider) { // Check if $slider is not null
        if (File::exists($slider->image)) {
            File::delete($slider->image);
        }
        
        if ($slider->delete()) {
            return redirect('admin/sliders')->with('success', 'Slider with Image Deleted Successfully');
        }

        return redirect('admin/sliders')->with('error', 'Something went wrong');
    }

    // Handle the case when the slider with the given $id doesn't exist
    return redirect('admin/sliders')->with('error', 'Slider not found');

    }
}