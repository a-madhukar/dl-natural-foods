<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;

class OrdersController extends Controller
{

    public function create()
    {
        $defaultCode = request()->default ?: ''; 

        if(isset($defaultCode))
        {
            $product = Product::findByUnqCode($defaultCode); 

            if(is_null($product)) $defaultCode = ""; 
        }
        return view('orders.create', compact('defaultCode')); 
    }


    public function show(Order $order)
    {
        $this->authorize('update', $order);

        $order->load('product'); 
        return view('orders.show', compact('order')); 
    }

    
    public function store()
    {
        $order = Order::persist(); 

        return response()->json([
            'data' => $order
        ], 201); 
    }


    public function edit(Order $order)
    {
        $this->authorize('update', $order);

        $order->load('product'); 

        return view('orders.edit', compact('order')); 
    }


    public function update(Order $order)
    {
        $this->authorize('update', $order);

        return response()->json([
            'data' => $order->updateInstance()
        ], 200); 
    }


    public function destroy(Order $order)
    {
        $this->authorize('update', $order);
        
        return response()->json([
            'data' => $order->delete()
        ],200);
    }
}
