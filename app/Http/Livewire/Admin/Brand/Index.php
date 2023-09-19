<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id, $name, $slug, $status, $brand_id, $message = '';
    protected $listeners = ['hideMessage'];
    
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }

    private function resetInputFields()
    {
        $this->category_id = '';
        $this->name = '';
        $this->slug = '';
        $this->status = '';
    }

    public function storeBrand()
    {
        Brand::create([
            'category_id'   => $this->category_id,
            'name'          => $this->name,
            'slug'          => Str::slug($this->slug),
            'status'        => $this->status == true ? '1' : '0',
        ]);

        $this->message = 'Brand Inserted Successfully';
        $this->dispatchBrowserEvent('hideMessage', ['delay' => 5000]);
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInputFields();
    }

    public function openModal()
    {
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->resetInputFields();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;

        $brand = Brand::findOrFail($brand_id);

        $this->category_id     = $brand->category_id;
        $this->name     = $brand->name;
        $this->slug     = $brand->slug;
        $this->status   = $brand->status;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();

        Brand::findOrFail($this->brand_id)->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInputFields();
    }

    public function showBrand(int $brand_id)
    {
        $brand = Brand::findOrFail($brand_id);

        $this->category_id     = $brand->category_id;
        $this->name     = $brand->name;
        $this->slug     = $brand->slug;
        $this->status   = $brand->status;
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        $brand = Brand::findOrFail($this->brand_id);
        $brand->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'Desc')->paginate(2);
        $categories = Category::where('status', '1')->get();
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])->extends('layouts.admin')->section('content');
    }

    public function hideMessage()
    {
        $this->message = '';
    }
}
