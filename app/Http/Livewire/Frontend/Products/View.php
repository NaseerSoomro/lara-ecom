<?php

namespace App\Http\Livewire\Frontend\Products;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function PHPSTORM_META\type;

class View extends Component
{
    public $category, $product, $product_images, $productColorQuantity = null, $colorProductId = 0;
    public $quantityCount = 1, $productDetail, $productColorId;

    public function colorSelected($productColorId)
    {
        // Find the color in the product's colors collection
        $productColor = DB::table('color_products')
            ->where('id', $productColorId)
            ->first();

        $this->productColorQuantity = $productColor->color_quantity;
        $this->colorProductId = $productColor->id;

        if (!$this->productColorQuantity) {
            $this->productColorQuantity = 'Out of Stock';
            $this->dispatchBrowserEvent('message', ['text' => $this->productColorQuantity, 'type' => 'info', 'status' => '401']);
            return false;
        }
    }

    public function quantityIncrement()

    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'You can not exceed the limit, the limit is 10', 'type' => 'info', 'status' => '401']);
            return false;
        }
    }

    public function quantityDecrement()

    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Quantity can not be less than 1', 'type' => 'info', 'status' => '401']);
            return false;
        }
    }

    public function addToWishlist($product_id)
    {
        $this->productColorId = $product_id;
        // dd($this->productColorId);
        if (Auth::check()) {
            $product_exists = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product_id)->exists();
            $this->emit('wishlistAddedOrUpdated');
            if ($product_exists) {
                $this->dispatchBrowserEvent('message', ['text' => 'Product Already exists in wishlist', 'type' => 'warning', 'status' => '409']);
                return false;
            } else {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product_id,
                ]);
                if ($wishlist->save()) {
                    $this->dispatchBrowserEvent('message', ['text' => 'Item added to wishlist successfully', 'type' => 'success', 'status' => '200']);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Please Login to contiune', 'type' => 'info', 'status' => '401']);
            return false;
        }
    }

    public function addToCart($product_id)
    {
        // dd($product_id);
        if (Auth::check()) {
            if ($this->product->where('id', $product_id)->where('status', 1)->exists()) {
                // dd($this->productColorId);
                if ($this->product->quantity) {
                    // Check if the product has any associated color products
                    $checkProductColors = DB::table('color_products')
                        ->where('product_id', $product_id)
                        ->count(); // Use count() to get the number of color products

                    if ($checkProductColors > 0) {
                        // else{
                        if ($this->productColorQuantity != NULL) {
                            // dd('else');
                            $productColorQuantityCheck = $this->product->colors->where('pivot.product_id', $product_id)->first();

                            $user_id = auth()->user()->id;
                            $exists = Cart::where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->where('color_product_id', $this->colorProductId)
                                ->exists();

                            if ($exists) {
                                $this->dispatchBrowserEvent('message', ['text' => 'product already exists', 'type' => 'info', 'status' => '401']);
                            } else {
                                // dd('else');
                                // dd($this->colorProductId, $this->quantityCount, $product_id);
                                if ($productColorQuantityCheck) {
                                    if ($this->productColorQuantity >= $this->quantityCount) {
                                        if ($this->productColorQuantity == 'Out of Stock') {
                                            $this->dispatchBrowserEvent('message', ['text' => 'Product is out of stock', 'type' => 'danger', 'status' => '404']);
                                        } else {
                                            Cart::create([
                                                'user_id' => auth()->user()->id,
                                                'product_id' => $product_id,
                                                'color_product_id' => $this->colorProductId,
                                                'quantity' => $this->quantityCount,
                                            ]);
                                            $this->emit('cartAddedOrUpdated');
                                            $this->dispatchBrowserEvent('message', ['text' => 'Product Added to Cart', 'type' => 'success', 'status' => '200']);
                                        }
                                    } else {
                                        $this->dispatchBrowserEvent('message', ['text' => 'you can not exceed product color quantity', 'type' => 'info', 'status' => '401']);
                                        return false;
                                    }
                                } else {
                                    $this->dispatchBrowserEvent('message', ['text' => 'Product does not have quantity in this color', 'type' => 'info', 'status' => '404']);
                                    return false;
                                }
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', ['text' => 'Please Select Color', 'type' => 'info', 'status' => '401']);
                            return false;
                        }
                        // }
                    } else {
                        $checkIfProductAlreadyExistsInCart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product_id)->exists();
                        if ($checkIfProductAlreadyExistsInCart) {
                            $this->dispatchBrowserEvent('message', ['text' => 'product already exists', 'type' => 'info', 'status' => '401']);
                            return false;
                        } else {
                            if ($this->product->quantity >= $this->quantityCount) {
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $product_id,
                                    'quantity' => $this->quantityCount,
                                ]);
                                $this->emit('cartAddedOrUpdated');
                                $this->dispatchBrowserEvent('message', ['text' => ' Product Added to Cart', 'type' => 'success', 'status' => '200']);
                            } else {
                                $this->dispatchBrowserEvent('message', ['text' => 'you can not exceed product color quantity', 'type' => 'info', 'status' => '401']);
                                return false;
                            }
                        }
                    }
                } else {
                    $this->dispatchBrowserEvent('message', ['text' => 'Product does not have quantity', 'type' => 'info', 'status' => '404']);
                    return false;
                }
            } else {
                $this->dispatchBrowserEvent('message', ['text' => 'Product Does not exists', 'type' => 'info', 'status' => '404']);
                return false;
            }
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Please Login to contiune', 'type' => 'info', 'status' => '401']);
            return false;
        }
    }
    public function mount($category, $product, $product_images)
    {
        $this->category = $category;
        $this->product = $product;
        $this->product_images = $product_images;
    }


    public function render()
    {
        return view('livewire.frontend.products.view', ['category' => $this->category, 'product' => $this->product, 'product_images' => $this->product_images,]);
    }
}
