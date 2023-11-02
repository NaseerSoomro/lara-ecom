<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $todayOrders = Carbon::now()->format('d-m-Y');
        $orders = Order::when($request->date, function ($query) use ($request) {
            return $query->whereDate('created_at', $request->date);
        }, function ($query) use ($todayOrders) {
            return $query->whereDate('created_at', $todayOrders);
        })
            ->when($request->status !== null && $request->status !== '', function ($query) use ($request) {
                return $query->where('status_message', $request->status);
            })
            ->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    public function update_status(int $order_id, Request $request)
    {
        // dd($order_id);
        // dd($request->all());
        $order = Order::where('id', $order_id)->first();
        // dd($order);
        if ($order) {
            $order->update([
                'status_message' => $request->status
            ]);
            return redirect()->back()->with('success', 'Order Status Updated Successfully');
        }
        return redirect()->back()->with('error', 'Id not Found');
    }

    public function show_invoice(int $orderId)
    {
        $order = Order::find($orderId);
        if($order){
            return view('admin.invoices.show_invoice', ['order' => $order]);
        }
        return redirect()->back()->with('error', 'Id not Found');
    }

    public function generate_invoice(int $orderId)
    {
        $order = Order::find($orderId);
        if($order){
            $data = ['order' => $order];
            $pdf = Pdf::loadView('admin.invoices.show_invoice', $data);
            $todayDate = Carbon::now()->format('d-m-Y');
            return $pdf->download('invoice-'.$orderId.'-'.$todayDate.'.pdf');
        }
        return redirect()->back()->with('error', 'Id not Found');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if ($order) {
            return view('admin.orders.show', ['order' => $order]);
        }
        return redirect()->back()->with('error', 'No Orders Available');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
