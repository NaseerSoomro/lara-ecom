<?php

namespace App\Http\Livewire\Frontend\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandList = [], $sortByPrice;

    protected $searchByBrands = ['brandList' => ['except' => '', 'as' => 'brand']];
    protected $searchByPrice = ['sortByPrice' => ['except' => '', 'as' => 'price']];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
            ->when($this->brandList, function ($query) {
                $query->whereIn('brand', $this->brandList);
            })
            ->when($this->sortByPrice, function ($query) {

                $query->when($this->sortByPrice == 'high-to-low', function ($q) {
                    $q->orderBy('selling_price', 'DESC');
                })
                    ->when($this->sortByPrice == 'low-to-high', function ($q) {
                        $q->orderBy('selling_price', 'ASC');
                    });
            })
            ->where('status', '1')
            ->get();

        return view('livewire.frontend.products.index', ['products' => $this->products, 'category' => $this->category]);
    }
}
