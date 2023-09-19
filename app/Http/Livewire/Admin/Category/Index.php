<?php

namespace App\Http\Livewire;

namespace App\Http\Livewire\Admin\Category;

use App\Models\Brand;
use App\Models\Category;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);

        if ($category) {
            // Delete the Image also if available
            $image_path = 'uploads/category/' . $category->image;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            // Delete related brands if available
            if ($category->brands()->count() > 0) {
                $category->brands()->delete();
                session()->flash('message', 'Category with Brands Deleted Successfully');
            }

            // Delete the category itself
            $category->delete();
            session()->flash('message', 'Category Deleted Successfully');
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('message', 'No Category Found');
        }

        return redirect()->back();
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
