<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;


class Show extends Component
{
    public function removeWishlistItem($wishlistId)
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->first();
        $this->emit('wishlistAddedOrUpdated');
        if ($wishlist) {
            if ($wishlist->delete()) {
                $this->dispatchBrowserEvent('message', ['text' => 'Item Removed from wishlist', 'type' => 'info', 'status' => '200']);
            }
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Item not Found', 'type' => 'danger', 'status' =>     '404']);
        }
    }
    public function render()
    {
        $wishlistProducts = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist.show', ['wishlistProducts' => $wishlistProducts]);
    }
}
