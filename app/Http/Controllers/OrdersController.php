<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only([
            'create'
        ]); 
    }


    public function create()
    {
        return view('orders.create'); 
    }

    
    public function store()
    {
        $order = Order::persist(); 

        return response()->json([
            'data' => $order
        ], 201); 
    }

}
