<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        // dd($orders);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($order_id)
    {
        $order = Order::where('user_id', auth()->user()->id)->where('id', $order_id)->first();
        if($order)
        {
            return view('frontend.orders.show', ['order' => $order]);
        }
        return redirect()->back()->with(['error', 'No Order Found']);
    }
}
