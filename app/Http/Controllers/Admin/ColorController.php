<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ColorFormRequest;

use App\Models\Color;
use App\Models\ColorProduct;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', ['colors' => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();

        $color = new Color;
        if ($color->create([
            'name'  => $validatedData['name'],
            'color_code'  => $validatedData['color_code'],
            'status'  => $request->status == true ? '1' : '0'
        ])) {
            return redirect('admin/colors')->with('success', 'Color Inserted Successfully');
        }
        return redirect('admin/colors')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $color = Color::findOrFail($id);
        return $color;
        // return view('admin.colors.edit', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorFormRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $color = Color::findOrFail($id);

        if ($color->update([
            'name'  => $validatedData['name'],
            'color_code'  => $validatedData['color_code'],
            'status'  => $request->status == true ? '1' : '0'
        ])) {
            return redirect('admin/colors')->with('success', 'Color Inserted Successfully');
        }
        return redirect('admin/colors')->with('error', 'Oops! Something went wrong');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Color::findOrFail($id)->delete();
        return redirect('admin/colors')->with('success', 'Color Deleted Successfully');
    }
}
