<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->status = '';
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Brand Inserted Successfully');
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

        $this->name     = $brand->name;
        $this->slug     = $brand->slug;
        $this->status   = $brand->status;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();

        Brand::findOrFail($this->brand_id)->update([
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
        $brands = Brand::orderBy('id','Desc')->paginate(2);
        return view('livewire.admin.brand.index', ['brands' => $brands])->extends('layouts.admin')->section('content');
    }
}