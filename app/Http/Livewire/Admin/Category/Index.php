<?php

namespace App\Http\Livewire;
namespace App\Http\Livewire\Admin\Category;

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
        $category = Category::findOrFail($this->category_id);

        // Delete the Image also if available
        $image_path = 'uploads/category/' . $category->image; {
            if (File::exists($image_path));
            File::delete($image_path);
        }
        $category->delete();
        session()->flash('message', 'Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
