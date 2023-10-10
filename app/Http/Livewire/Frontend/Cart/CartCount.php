<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartCount extends Component
{

    public $cartCount;

    protected $listeners = ['cartAddedOrUpdated' => 'cartCount'];

    public function cartCount()
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->user()->id)->count();
        } else {
            return 0;
        }
    }

    public function render()
    {
        $this->cartCount = $this->cartCount();
        return view('livewire.frontend.cart.cart-count', ['cartCount' => $this->cartCount]);
    }
}
