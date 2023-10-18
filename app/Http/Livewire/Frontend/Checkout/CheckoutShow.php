<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $cartItems, $totalProductAmount = 0;
    public $fullName, $phone, $email, $pinCode, $address;
    public $paymentMode, $paymentId;

    public function rules()
    {
        return [
            'fullName' => 'required|string|max:20',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:30',
            'pinCode' => 'required|integer',
            'address' => 'required|string',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'Ecom' . Str::random('10'),
            'full_name' => $this->fullName,
            'phone' => $this->phone,
            'email' => $this->email,
            'pin_code' => $this->pinCode,
            'address' => $this->address,
            'status_message' => 'In Process',
            'payment_mode' => $this->paymentMode,
            'payment_id' => $this->paymentId,
        ]);

        // dd($this->cartItems);

        foreach ($this->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'color_product_id' => $cartItem->color_product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price * $cartItem->quantity,
            ]);
        }

        if($cartItem->color_product_id)
        {
            $cartItem->color_products()->where('id', $cartItem->color_product_id)->decrement('color_quantity', $cartItem->quantity);
        }
        else{            
            $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
        }

        return $order;
    }

    public function codOrder()
    {
        $this->paymentMode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        if ($codOrder) {
            Cart::where('user_id', auth()->user()->id)->delete();
            // $this->emit('CartAddedOrUpdated');
            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', ['text' => 'Order Placed Successfully', 'type' => 'success', 'status' => '200']);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Something went wrong', 'type' => 'error', 'status' => '500']);
        }
    }

    public function totalProductAmount()
    {
        $this->cartItems = Cart::where('user_id', auth()->user()->id)->get();
        // dd()
        $this->totalProductAmount = 0;
        if ($this->cartItems) {
            foreach ($this->cartItems as $cartItem) {
                $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }
            return $this->totalProductAmount;
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Item not Found', 'type' => 'error', 'status' =>     '404']);
            return $this->totalProductAmount;
        }
    }

    public function render()
    {
        $this->fullName = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', ['totalProductAmount' => $this->totalProductAmount]);
    }
}
