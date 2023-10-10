<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistCount extends Component
{

    public $wishlistCount;

    protected $listeners = ['wishlistAddedOrUpdated' => 'wishlistCount'];

    public function wishlistCount()
    {
        if (auth()->check()) {
            return Wishlist::where('user_id', auth()->user()->id)->count();
        } else {
            return 0;
        }
    }

    public function render()
    {
        $this->wishlistCount = $this->wishlistCount();
        return view('livewire.frontend.wishlist.wishlist-count', ['wishlistCount' => $this->wishlistCount]);
    }
}
