<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class Show extends Component
{
    public $cartItems, $totalPrice = 0;

    public function increaseQuantity($cartId)
    {
        $cartItem = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartItem) {
            if ($cartItem->product->quantity) {
                $cartItemCheck = $cartItem->color_products()->where('id', $cartItem->color_product_id)->first();
                // dd($cartItem->color_products->color_quantity);
                if ($cartItemCheck) {
                    // dd($cartItemCheck->color_quantity);
                    if ($cartItem->color_products->color_quantity) {
                        if ($cartItem->color_products->color_quantity > $cartItem->quantity) {
                            $cartItem->increment('quantity');
                            return $this->dispatchBrowserEvent('message', ['text' => 'Quantity Increased Successfully', 'type' => 'success', 'status' => '200']);
                        } else {
                            return $this->dispatchBrowserEvent('message', ['text' => "You can't exceed the available quantity", 'type' => 'warning', 'status' => '200']);
                        }
                    } else {
                        return $this->dispatchBrowserEvent('message', ['text' => "Color quantity is not available", 'type' => 'warning', 'status' => '200']);
                    }
                } else {
                    if ($cartItem->product->quantity > $cartItem->quantity) {
                        $cartItem->increment('quantity');
                        return $this->dispatchBrowserEvent('message', ['text' => 'Quantity Increased Successfully', 'type' => 'success', 'status' => '401']);
                    } else {
                        return $this->dispatchBrowserEvent('message', ['text' => "You can't exceed the available quantity", 'type' => 'warning', 'status' => '401']);
                    }
                }
            } else {
                return $this->dispatchBrowserEvent('message', ['text' => 'Quantity is not available', 'type' => 'success', 'status' => '200']);
            }
        }
        return  $this->dispatchBrowserEvent('message', ['text' => 'Item not found', 'type' => 'info', 'status' => '404']);
    }

    public function decreaseQuantity($cartId)
    {
        $cartItem = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartItem) {
            if ($cartItem->quantity < 2) {
                return $this->dispatchBrowserEvent('message', ['text' => 'Qauntity can not be less than 1', 'type' => 'danger', 'status' => '200']);
            } else {
                $cartItem->decrement('quantity');
                return $this->dispatchBrowserEvent('message', ['text' => 'Quantity Decreased', 'type' => 'error', 'status' => '200']);
            }
        }
        return  $this->dispatchBrowserEvent('message', ['text' => 'Item not found', 'type' => 'info', 'status' => '404']);
    }

    // Remove CartItem
    public function removeCartItem($cartId)
    {
        $cartItem = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if ($cartItem) {
            if ($cartItem->delete()) {
                $this->emit('cartAddedOrUpdated');
                return $this->dispatchBrowserEvent('message', ['text' => 'Item Removed from Cart', 'type' => 'error', 'status' => '200']);
            } else {
                return $this->dispatchBrowserEvent('message', ['text' => 'Something went wrong while removing item', 'type' => 'error', 'status' => '500']);
            }
        }
        return  $this->dispatchBrowserEvent('message', ['text' => 'Item not found', 'type' => 'info', 'status' => '404']);
    }

    public function render()
    {
        $this->cartItems = Cart::where('user_id', auth()->user()->id)->get();
        // dd(isset($this->cartItems));
        return view('livewire.frontend.cart.show', ['cartItems' => $this->cartItems]);
    }
}
