<?php

namespace App\Http\Livewire\Frontend\Products;

use Livewire\Component;

class Index extends Component
{
    public $products, $category_products;
    public function mount($products, $category_products)
    {
        $this->products = $products;
        $this->category_products = $category_products;
    }

    public function render()
    {
        return view('livewire.frontend.products.index', ['products' => $this->products, 'category_products' => $this->category_products]);
    }
}
