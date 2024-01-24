<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Order;
use App\unauht;
use Illuminate\Http\Request;
use Session;


class unAuthController extends Controller
{

    public function index(Request $request)
    {
        return view('front.cart.unAuth');
    }

    public function store(Request $request)
    {
        $data = Order::where('ip', $request->ip())
            ->where('status', '1')
            ->with('Carts.Product', 'OrderProducts.Product')
            ->latest()
            ->first();

        foreach ($data->carts as $item) {
            unauht::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'product_id' => $item->product->id,
                'order_id' => $data->id,
                'status' => 1,
            ]);
        }
        return redirect()->back()->with('success', 'done order!');
    }
    public function unAuthOrders()
    {
        $Orders = unauht::where('status', 1)->get();
        return view('unAuth', compact('Orders'));
    }

    public function updateOrderStatus($orderId)
    {
        $order = unauht::find($orderId);
        $order->update([
            'status' => 0
        ]);
        return redirect()->back()->with('success', 'done!');
    }
    public function deleteOrder($orderId)
    {
        $order = unauht::find($orderId);
        $order->delete();
        return redirect()->back()->with('success', 'done deleted!');
    }

    public function APIstore(Request $request)
    {
        $data = Order::where('ip', $request->ip())
            ->where('status', '1')
            ->with('Carts.Product', 'OrderProducts.Product')
            ->latest()
            ->first();

        foreach ($data->carts as $item) {
            unauht::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'product_id' => $item->product->id,
                'order_id' => $data->id,
                'status' => 1,
            ]);
        }
        return response()->json('done order');
    }
}
