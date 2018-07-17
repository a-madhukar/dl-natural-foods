<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('date','desc')
        ->with('product', 'user')
        ->when(!auth()->user()->isAdmin(), function($query){
            $query->whereUserId(auth()->user()->id); 
        })
        ->when(request()->unq_code, function($query){
            $query->whereHas('product', function($query){
                $query->whereUnqCode(request()->unq_code); 
            }); 
        })->paginate(30); 

        $codes = Product::pluck('unq_code')->unique();
        
        // dd($products); 

        return view('home', compact('orders','codes'));
    }
}
